<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\FullTime;
use App\Models\Categoria;
use App\Models\Horario;


class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $users = User::latest()->paginate(10);
        foreach ($users as $user) {
            $user->sedeObject = Sede::where('id', $user->sede)->first();
            $user->fullTimeObject = FullTime::where('id', $user->fullTime)->first();
            $user->categoriaObject = Categoria::where('id', $user->categoria)->first();
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('users.create',[
            'roles' => Role::latest()->get(),
            'full_times'=> FullTime::latest()->get(),
            'categorias'=> Categoria::latest()->get(),
            'horarios'=> Horario::latest()->get(),
            'sedes'=> Sede::latest()->get()
        ]);
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {

        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test' 
        ]));
        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('Usuario creado correctamente.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        $user->sedeObject = Sede::where('id', $user->sede)->first();
        $user->fullTimeObject = FullTime::where('id', $user->fullTime)->first();
        $user->categoriaObject = Categoria::where('id', $user->categoria)->first();
        $user->horarioObject = Horario::where('id', $user->horario)->first();
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {

        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get(),
            'full_times'=> FullTime::latest()->get(),
            'categorias'=> Categoria::latest()->get(),
            'horarios'=> Horario::latest()->get(),
            'sedes'=> Sede::latest()->get()
        ]);
    }
    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {
        $user->update($request->validated());
        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('Usuario actualizado correctamente.'));
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('Usuario eliminado correctamente.'));
    }

}