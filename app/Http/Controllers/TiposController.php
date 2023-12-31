<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;


class Tiposontroller extends Controller
{
    /**
     * Display all tipos
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::latest()->paginate(10);

        return view('tipos.index', compact('tipos'));
    }

    /**
     * Show form for creating tipo
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipos.create');
    }

    /**
     * Store a newly created tipo
     * 
     * @param Tipo $tipo
     * @param StoreTipoRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Tipo $tipo, StoreTipoRequest $request)
    {
        //For demo purposes only. When creating tipo or inviting a tipo
        // you should create a generated random password and email it to the tipo
        $tipo->create(array_merge($request->validated()));

        return redirect()->route('tipos.index')
            ->withSuccess(__('Tipo registrada correctamente.'));
    }

    /**
     * Show tipo data
     * 
     * @param Tipo $tipo
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo $tipo)
    {
        return view('tipos.show', [
            'tipo' => $tipo
        ]);
    }

    /**
     * Edit tipo data
     * 
     * @param Tipo $tipo
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
    {

        return view('tipos.edit', [
            'tipo' => $tipo])
        ;
    }
    
    /**
     * Update tipo data
     * 
     * @param Tipo $tipo
     * @param UpdateTipoRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Tipo $tipo, UpdateTipoRequest $request)
    {
        $tipo->update($request->validated());

        return redirect()->route('tipos.index')
            ->withSuccess(__('Tipo actualizada correctamente.'));
    }

    /**
     * Delete tipo data
     * 
     * @param Tipo $tipo
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo $tipo)
    {
        $tipo->delete();

        return redirect()->route('tipos.index')
            ->withSuccess(__('Tipo eliminada correctamente.'));
    }


}
