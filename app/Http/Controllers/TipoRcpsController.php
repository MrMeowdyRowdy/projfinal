<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoRcpRequest;
use App\Http\Requests\UpdateTipoRcpRequest;
use App\Models\TipoRcp;
use Illuminate\Http\Request;


class TipoRcpsController extends Controller
{
    /**
     * Display all tipoRcps
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoRcps = TipoRcp::latest()->paginate(10);

        return view('tipoRcps.index', compact('tipoRcps'));
    }

    /**
     * Show form for creating tipoRcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoRcps.create');
    }

    /**
     * Store a newly created tipoRcp
     * 
     * @param TipoRcp $tipoRcp
     * @param StoreTipoRcpRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(TipoRcp $tipoRcp, StoreTipoRcpRequest $request)
    {
        //For demo purposes only. When creating tipoRcp or inviting a tipoRcp
        // you should create a generated random password and email it to the tipoRcp
        $tipoRcp->create(array_merge($request->validated()));

        return redirect()->route('tipoRcps.index')
            ->withSuccess(__('TipoRcp registrada correctamente.'));
    }

    /**
     * Show tipoRcp data
     * 
     * @param TipoRcp $tipoRcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(TipoRcp $tipoRcp)
    {
        return view('tipoRcps.show', [
            'tipoRcp' => $tipoRcp
        ]);
    }

    /**
     * Edit tipoRcp data
     * 
     * @param TipoRcp $tipoRcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoRcp $tipoRcp)
    {

        return view('tipoRcps.edit', [
            'tipoRcp' => $tipoRcp])
        ;
    }
    
    /**
     * Update tipoRcp data
     * 
     * @param TipoRcp $tipoRcp
     * @param UpdateTipoRcpRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(TipoRcp $tipoRcp, UpdateTipoRcpRequest $request)
    {
        $tipoRcp->update($request->validated());

        return redirect()->route('tipoRcps.index')
            ->withSuccess(__('TipoRcp actualizada correctamente.'));
    }

    /**
     * Delete tipoRcp data
     * 
     * @param TipoRcp $tipoRcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoRcp $tipoRcp)
    {
        $tipoRcp->delete();

        return redirect()->route('tipoRcps.index')
            ->withSuccess(__('TipoRcp eliminada correctamente.'));
    }
}
