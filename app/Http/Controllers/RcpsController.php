<?php

namespace App\Http\Controllers;

use App\Models\Catastrofico;
use App\Models\TipoRcp;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRCPRequest;
use App\Http\Requests\UpdateRCPRequest;
use App\Models\Rcp;
use Illuminate\Support\Facades\Auth;


class RcpsController extends Controller
{
    /**
     * Display all rcps
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters['column'] = 'interpreterID';
        $filters['value'] = auth()->id();
        
        
        if((Auth::user()->hasRole('TeamLeader')))
        {
            $rcps = Rcp::latest()->paginate(10);
        }
        else{
            
            $rcps = Rcp::select('*')
                    ->where($filters['column'], $filters['value'])->get();
        }
        foreach ($rcps as $rcp) {
            $rcp->rcpTipoObject = TipoRcp::where('id', $rcp->tipo)->first();
            $rcp->catastroficoObject = Catastrofico::where('id', $rcp->catastrofico)->first();
        }

        return view('rcps.index', compact('rcps'));
    }

    /**
     * Show form for creating rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('rcps.create', [
            'tipoRcps' => TipoRcp::latest()->get(),
            'catastroficos' => Catastrofico::latest()->get(),
            'llamadaID' => $request['id'],
        ]);
    }

    /**
     * Store a newly created rcp
     * 
     * @param Rcp $rcp
     * @param StoreRcpRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Rcp $rcp, StoreRcpRequest $request)
    {
        //For demo purposes only. When creating rcp or inviting a rcp
        // you should create a generated random password and email it to the rcp
        Rcp::create(array_merge($request->only('llamadaID', 'tipo', 'catastrofico','mensaje'), [
            'interpreterID' => auth()->id()
        ]));
        return redirect()->route('rcps.index')
            ->withSuccess(__('Rcp registrada correctamente.'));
    }

    /**
     * Show rcp data
     * 
     * @param Rcp $rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Rcp $rcp)
    {
        $rcp->rcpTipoObject = TipoRcp::where('id', $rcp->tipo)->first();
        $rcp->catastroficoObject = Catastrofico::where('id', $rcp->catastrofico)->first();
        return view('rcps.show', [
            'rcp' => $rcp
        ]);
    }

    /**
     * Edit rcp data
     * 
     * @param Rcp $rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Rcp $rcp)
    {

        return view('rcps.edit', [
            'rcp' => $rcp,
            'catastroficos' => Catastrofico::latest()->get(),
            'tipoRcps' => TipoRcp::latest()->get()])
        ;
    }
    /**
     * Update rcp data
     * 
     * @param Rcp $rcp
     * @param UpdateRcpRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Rcp $rcp, UpdateRcpRequest $request)
    {
        $rcp->update($request->validated());

        return redirect()->route('rcps.index')
            ->withSuccess(__('Rcp actualizada correctamente.'));
    }

    /**
     * Delete rcp data
     * 
     * @param Rcp $rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rcp $rcp)
    {
        $rcp->delete();

        return redirect()->route('rcps.index')
            ->withSuccess(__('Rcp eliminada correctamente.'));
    }
}
