<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRCPRequest;
use App\Http\Requests\UpdateRCPRequest;
use App\Models\RCP;

class RcpController extends Controller
{
     /**
     * Display all rcps
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $rcps = RCP::latest()->paginate(10);

        return view('rcps.index', compact('rcps'));
    }

    /**
     * Show form for creating rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('rcps.create');
    }

    /**
     * Store a newly created rcp
     * 
     * @param RCP $rcp
     * @param StoreRCPRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(RCP $rcp, StoreRCPRequest $request) 
    {
        //For demo purposes only. When creating rcp or inviting a rcp
        // you should create a generated random password and email it to the rcp
        $rcp->create(array_merge($request->validated(), [
            'password' => 'test' 
        ]));

        return redirect()->route('rcps.index')
            ->withSuccess(__('RCP registrada correctamente.'));
    }

    /**
     * Show rcp data
     * 
     * @param RCP $rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(RCP $rcp) 
    {
        return view('rcps.show', [
            'rcp' => $rcp
        ]);
    }

    /**
     * Edit rcp data
     * 
     * @param RCP $rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(RCP $rcp) 
    {

        return view('rcps.edit', [
            'rcp' => $rcp])
        ;
    }
    /**
     * Update rcp data
     * 
     * @param RCP $rcp
     * @param UpdateRCPRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(RCP $rcp, UpdateRCPRequest $request) 
    {
        $rcp->update($request->validated());

        return redirect()->route('rcps.index')
            ->withSuccess(__('RCP actualizada correctamente.'));
    }

    /**
     * Delete rcp data
     * 
     * @param RCP $rcp
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(RCP $rcp) 
    {
        $rcp->delete();

        return redirect()->route('rcps.index')
            ->withSuccess(__('RCP eliminada correctamente.'));
    }
}
