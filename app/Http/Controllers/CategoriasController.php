<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;


class CategoriasController extends Controller
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
        $categorias = Categoria::orderBy('id', 'DESC')->paginate(5);
        return view('categorias.index', compact('categorias'))
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
        return view('categorias.create', compact('permissions'));
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
            'name' => 'required|unique:categorias,name',
            'permission' => 'required',
        ]);

        $categoria = Categoria::create(['name' => $request->get('name')]);
        $categoria->syncPermissions($request->get('permission'));

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        $categoria = $categoria;
        $categoriaPermissions = $categoria->permissions;

        return view('categorias.show', compact('categoria', 'categoriaPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        $categoria = $categoria;
        $categoriaPermissions = $categoria->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return view('categorias.edit', compact('categoria', 'categoriaPermissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Categoria $categoria, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $categoria->update($request->only('name'));

        $categoria->syncPermissions($request->get('permission'));

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria deleted successfully');
    }
}
