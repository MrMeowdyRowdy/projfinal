<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FullTime;


class FullTimeController extends Controller
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
        $full_times = FullTime::orderBy('id','DESC')->paginate(5);
        return view('full_times.index',compact('full_times'))
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
        return view('full_times.create', compact('permissions'));
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
            'name' => 'required|unique:full_times,name',
            'permission' => 'required',
        ]);
    
        $full_time = FullTime::create(['name' => $request->get('name')]);
        $full_time->syncPermissions($request->get('permission'));
    
        return redirect()->route('full_times.index')
                        ->with('success','FullTime created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FullTime $full_time)
    {
        $full_time = $full_time;
        $full_timePermissions = $full_time->permissions;
    
        return view('full_times.show', compact('full_time', 'full_timePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FullTime $full_time)
    {
        $full_time = $full_time;
        $full_timePermissions = $full_time->permissions->pluck('name')->toArray();
        $permissions = Permission::get();
    
        return view('full_times.edit', compact('full_time', 'full_timePermissions', 'permissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FullTime $full_time, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        
        $full_time->update($request->only('name'));
    
        $full_time->syncPermissions($request->get('permission'));
    
        return redirect()->route('full_times.index')
                        ->with('success','FullTime updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FullTime $full_time)
    {
        $full_time->delete();

        return redirect()->route('full_times.index')
                        ->with('success','FullTime deleted successfully');
    }
}
