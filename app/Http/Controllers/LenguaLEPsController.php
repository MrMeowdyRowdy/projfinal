<?php

namespace App\Http\Controllers;

use App\Models\LenguaLEP;
use Illuminate\Http\Request;

class LenguaLEPsController extends Controller
{
     /**
     * Display all lenguaLEPs
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $lenguaLEPs = LenguaLEP::latest()->paginate(10);

        return view('lenguaLEPs.index', compact('lenguaLEPs'));
    }

    /**
     * Show form for creating lenguaLEP
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('lenguaLEPs.create');
    }

    /**
     * Store a newly created lenguaLEP
     * 
     * @param LenguaLEP $lenguaLEP
     * @param StoreLenguaLEPRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(LenguaLEP $lenguaLEP, StoreLenguaLEPRequest $request) 
    {
        //For demo purposes only. When creating lenguaLEP or inviting a lenguaLEP
        // you should create a generated random password and email it to the lenguaLEP
        $lenguaLEP->create(array_merge($request->validated()));

        return redirect()->route('lenguaLEPs.index')
            ->withSuccess(__('LenguaLEP registrada correctamente.'));
    }

    /**
     * Show lenguaLEP data
     * 
     * @param LenguaLEP $lenguaLEP
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(LenguaLEP $lenguaLEP) 
    {
        return view('lenguaLEPs.show', [
            'lenguaLEP' => $lenguaLEP
        ]);
    }

    /**
     * Edit lenguaLEP data
     * 
     * @param LenguaLEP $lenguaLEP
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(LenguaLEP $lenguaLEP) 
    {

        return view('lenguaLEPs.edit', [
            'lenguaLEP' => $lenguaLEP])
        ;
    }
    /**
     * Update lenguaLEP data
     * 
     * @param LenguaLEP $lenguaLEP
     * @param UpdateLenguaLEPRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(LenguaLEP $lenguaLEP, UpdateLenguaLEPRequest $request) 
    {
        $lenguaLEP->update($request->validated());

        return redirect()->route('lenguaLEPs.index')
            ->withSuccess(__('LenguaLEP actualizada correctamente.'));
    }

    /**
     * Delete lenguaLEP data
     * 
     * @param LenguaLEP $lenguaLEP
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(LenguaLEP $lenguaLEP) 
    {
        $lenguaLEP->delete();

        return redirect()->route('lenguaLEPs.index')
            ->withSuccess(__('LenguaLEP eliminada correctamente.'));
    }
}
