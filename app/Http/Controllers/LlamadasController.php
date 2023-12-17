<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Llamada;

class LlamadasController extends Controller
{
     /**
     * Display all llamadas
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $llamadas = Llamada::latest()->paginate(10);

        return view('llamadas.index', compact('llamadas'));
    }

    /**
     * Show form for creating llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('llamadas.create');
    }

    /**
     * Store a newly created llamada
     * 
     * @param Llamada $llamada
     * @param StoreLlamadaRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Llamada $llamada, StoreLlamadaRequest $request) 
    {
        //For demo purposes only. When creating llamada or inviting a llamada
        // you should create a generated random password and email it to the llamada
        $llamada->create(array_merge($request->validated(), [
            'password' => 'test' 
        ]));

        return redirect()->route('llamadas.index')
            ->withSuccess(__('Llamada registrada correctamente.'));
    }

    /**
     * Show llamada data
     * 
     * @param Llamada $llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Llamada $llamada) 
    {
        return view('llamadas.show', [
            'llamada' => $llamada
        ]);
    }

    /**
     * Edit llamada data
     * 
     * @param Llamada $llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Llamada $llamada) 
    {

        return view('llamadas.edit');
    }
    /**
     * Update llamada data
     * 
     * @param Llamada $llamada
     * @param UpdateLlamadaRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Llamada $llamada, UpdateLlamadaRequest $request) 
    {
        $llamada->update($request->validated());
        $llamada->syncRoles($request->get('role'));

        return redirect()->route('llamadas.index')
            ->withSuccess(__('Llamada actualizada correctamente.'));
    }

    /**
     * Delete llamada data
     * 
     * @param Llamada $llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Llamada $llamada) 
    {
        $llamada->delete();

        return redirect()->route('llamadas.index')
            ->withSuccess(__('Llamada eliminada correctamente.'));
    }
}
