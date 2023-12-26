<?php

namespace App\Http\Controllers;

use App\Models\TipoRcp;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRCPRequest;
use App\Http\Requests\UpdateRCPRequest;
use App\Models\Rcp;

class RcpsController extends Controller
{
    /**
     * Display all rcps
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rcps = Rcp::latest()->paginate(10);

        return view('rcps.index', compact('rcps'));
    }

    /**
     * Show form for creating rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rcps.create', [
            'tipoRcps' => TipoRcp::latest()->get()
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
        dd($rcp);
        Rcp::create(array_merge($request->only('llamadaID', 'tipo', 'mensaje'), [
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
