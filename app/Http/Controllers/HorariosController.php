<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Http\Requests\StoreHorarioRequest;
use App\Http\Requests\UpdateHorarioRequest;


class HorariosController extends Controller
{
    /**
     * Display all horarios
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::latest()->paginate(10);

        return view('horarios.index', compact('horarios'));
    }

    /**
     * Show form for creating horario
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horarios.create');
    }

    /**
     * Store a newly created horario
     * 
     * @param Horario $horario
     * @param StoreHorarioRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Horario $horario, StoreHorarioRequest $request)
    {
        //For demo purposes only. When creating horario or inviting a horario
        // you should create a generated random password and email it to the horario
        $horario->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect()->route('horarios.index')
            ->withSuccess(__('Horario registrada correctamente.'));
    }

    /**
     * Show horario data
     * 
     * @param Horario $horario
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        return view('horarios.show', [
            'horario' => $horario
        ]);
    }

    /**
     * Edit horario data
     * 
     * @param Horario $horario
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {

        return view('horarios.edit', [
            'horario' => $horario])
        ;
    }
    /**
     * Update horario data
     * 
     * @param Horario $horario
     * @param UpdateHorarioRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Horario $horario, UpdateHorarioRequest $request)
    {
        $horario->update($request->validated());

        return redirect()->route('horarios.index')
            ->withSuccess(__('Horario actualizada correctamente.'));
    }

    /**
     * Delete horario data
     * 
     * @param Horario $horario
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.index')
            ->withSuccess(__('Horario eliminada correctamente.'));
    }
}
