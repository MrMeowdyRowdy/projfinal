<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSedesRequest;
use App\Http\Requests\UpdateSedesRequest;
use App\Models\Sede;
use Illuminate\Http\Request;

class SedesController extends Controller
{
    /**
     * Display all sedes
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::latest()->paginate(10);

        return view('sedes.index', compact('sedes'));
    }

    /**
     * Show form for creating sede
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sedes.create');
    }

    /**
     * Store a newly created sede
     * 
     * @param Sede $sede
     * @param StoreSedesRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Sede $sede, StoreSedesRequest $request)
    {
        //For demo purposes only. When creating sede or inviting a sede
        // you should create a generated random password and email it to the sede
        $sede->create(array_merge($request->validated()));

        return redirect()->route('sedes.index')
            ->withSuccess(__('Sede registrada correctamente.'));
    }

    /**
     * Show sede data
     * 
     * @param Sede $sede
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Sede $sede)
    {
        return view('sedes.show', [
            'sede' => $sede
        ]);
    }

    /**
     * Edit sede data
     * 
     * @param Sede $sede
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Sede $sede)
    {

        return view('sedes.edit', [
            'sede' => $sede])
        ;
    }

    /**
     * Update sede data
     * 
     * @param Sede $sede
     * @param UpdateSedesRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Sede $sede, UpdateSedesRequest $request)
    {
        $sede->update($request->validated());

        return redirect()->route('sedes.index')
            ->withSuccess(__('Sede actualizado correctamente.'));
    }

    /**
     * Delete sede data
     * 
     * @param Sede $sede
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sede $sede)
    {
        $sede->delete();

        return redirect()->route('sedes.index')
            ->withSuccess(__('Sede eliminada correctamente.'));
    }
}
