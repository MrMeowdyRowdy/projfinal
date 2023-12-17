<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;

class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $horarios = Horario::orderBy('id','DESC')->paginate(5);
        return view('horarios.index',compact('horarios'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('horarios.create', compact('permissions'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:horarios,name',
            'permission' => 'required',
        ]);
    
        $horario = Horario::create(['name' => $request->get('name')]);
        $horario->syncPermissions($request->get('permission'));
    
        return redirect()->route('horarios.index')
                        ->with('success','Horario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        $horario = $horario;
        $horarioPermissions = $horario->permissions;
    
        return view('horarios.show', compact('horario', 'horarioPermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        $horario = $horario;
        $horarioPermissions = $horario->permissions->pluck('name')->toArray();
        $permissions = Permission::get();
    
        return view('horarios.edit', compact('horario', 'horarioPermissions', 'permissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Horario $horario, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        
        $horario->update($request->only('name'));
    
        $horario->syncPermissions($request->get('permission'));
    
        return redirect()->route('horarios.index')
                        ->with('success','Horario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.index')
                        ->with('success','Horario eliminado correctamente');
    }
}
