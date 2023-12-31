<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpresaClientesRequest;
use App\Http\Requests\UpdateEmpresaClientesRequest;
use App\Models\EmpresaCliente;
use Illuminate\Http\Request;

class EmpresaClientesController extends Controller
{
    /**
     * Display all empresaClientes
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresaClientes = EmpresaCliente::latest()->paginate(10);

        return view('empresaClientes.index', compact('empresaClientes'));
    }

    /**
     * Show form for creating empresaCliente
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresaClientes.create');
    }

    /**
     * Store a newly created empresaCliente
     * 
     * @param EmpresaCliente $empresaCliente
     * @param StoreEmpresaClientesRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaCliente $empresaCliente, StoreEmpresaClientesRequest $request)
    {
        //For demo purposes only. When creating empresaCliente or inviting a empresaCliente
        // you should create a generated random password and email it to the empresaCliente
        $empresaCliente->create(array_merge($request->validated()));

        return redirect()->route('empresaClientes.index')
            ->withSuccess(__('EmpresaCliente registrada correctamente.'));
    }

    /**
     * Show empresaCliente data
     * 
     * @param EmpresaCliente $empresaCliente
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(EmpresaCliente $empresaCliente)
    {
        return view('empresaClientes.show', [
            'empresaCliente' => $empresaCliente
        ]);
    }

    /**
     * Edit empresaCliente data
     * 
     * @param EmpresaCliente $empresaCliente
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpresaCliente $empresaCliente)
    {

        return view('empresaClientes.edit', [
            'empresaCliente' => $empresaCliente])
        ;
    }
    /**
     * Update empresaCliente data
     * 
     * @param EmpresaCliente $empresaCliente
     * @param UpdateEmpresaClientesRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaCliente $empresaCliente, UpdateEmpresaClientesRequest $request)
    {
        $empresaCliente->update($request->validated());

        return redirect()->route('empresaClientes.index')
            ->withSuccess(__('EmpresaCliente actualizado correctamente.'));
    }

    /**
     * Delete empresaCliente data
     * 
     * @param EmpresaCliente $empresaCliente
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpresaCliente $empresaCliente)
    {
        $empresaCliente->delete();

        return redirect()->route('empresaClientes.index')
            ->withSuccess(__('EmpresaCliente eliminada correctamente.'));
    }
}
