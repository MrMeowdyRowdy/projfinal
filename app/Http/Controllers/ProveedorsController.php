<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProveedorsRequest;
use App\Http\Requests\UpdateProveedorsRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;


class ProveedorsController extends Controller
{
     /**
     * Display all proveedors
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $proveedors = Proveedor::latest()->paginate(10);

        return view('proveedors.index', compact('proveedors'));
    }

    /**
     * Show form for creating proveedor
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('proveedors.create');
    }

    /**
     * Store a newly created proveedor
     * 
     * @param Proveedor $proveedor
     * @param StoreProveedorsRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Proveedor $proveedor, StoreProveedorsRequest $request) 
    {
        //For demo purposes only. When creating proveedor or inviting a proveedor
        // you should create a generated random password and email it to the proveedor
        $proveedor->create(array_merge($request->validated()));

        return redirect()->route('proveedors.index')
            ->withSuccess(__('Proveedor registrada correctamente.'));
    }

    /**
     * Show proveedor data
     * 
     * @param Proveedor $proveedor
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor) 
    {
        return view('proveedors.show', [
            'proveedor' => $proveedor
        ]);
    }

    /**
     * Edit proveedor data
     * 
     * @param Proveedor $proveedor
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor) 
    {

        return view('proveedors.edit', [
            'proveedor' => $proveedor])
        ;
    }
    /**
     * Update proveedor data
     * 
     * @param Proveedor $proveedor
     * @param UpdateProveedorsRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Proveedor $proveedor, UpdateProveedorsRequest $request) 
    {
        $proveedor->update($request->validated());

        return redirect()->route('proveedors.index')
            ->withSuccess(__('Proveedor actualizado correctamente.'));
    }

    /**
     * Delete proveedor data
     * 
     * @param Proveedor $proveedor
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor) 
    {
        $proveedor->delete();

        return redirect()->route('proveedors.index')
            ->withSuccess(__('Proveedor eliminada correctamente.'));
    }
}
