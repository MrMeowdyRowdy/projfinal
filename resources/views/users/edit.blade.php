@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @
                <div class="mb-3">
                    <label for="nroDocIdentificacion" class="form-label">Cédula</label>
                    <input value="{{ $user->nroDocIdentificacion }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="1700000000" required>

                    @if ($errors->has('nroDocIdentificacion'))
                        <span class="text-danger text-left">{{ $errors->first('nroDocIdentificacion') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="sede" class="form-label">Sede</label>
                    <input value="{{ $user->sede }}" 
                        type="text" 
                        class="form-control" 
                        name="sede" 
                        placeholder="ECU" required>

                    @if ($errors->has('sede'))
                        <span class="text-danger text-left">{{ $errors->first('sede') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input value="{{ $user->apellido }}" 
                        type="text" 
                        class="form-control" 
                        name="apellido" 
                        placeholder="Apellido" required>

                    @if ($errors->has('apellido'))
                        <span class="text-danger text-left">{{ $errors->first('apellido') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input value="{{ $user->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Nombre" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="tlfContacto" class="form-label">Teléfono</label>
                    <input value="{{ $user->tlfContacto }}" 
                        type="text" 
                        class="form-control" 
                        name="tlfContacto" 
                        placeholder="0900000000" required>

                    @if ($errors->has('tlfContacto'))
                        <span class="text-danger text-left">{{ $errors->first('tlfContacto') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $user->email }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="john@doe.com" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="emailRackspace" class="form-label">Email Rackspace</label>
                    <input value="{{ $user->emailRackspace }}"
                        type="email" 
                        class="form-control" 
                        name="emailRackspace" 
                        placeholder="john@doe.com" required>
                    @if ($errors->has('emailRackspace'))
                        <span class="text-danger text-left">{{ $errors->first('emailRackspace') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="{{ $user->username }}"
                        type="text" 
                        class="form-control" 
                        name="username" 
                        placeholder="Username" required>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" 
                        name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ in_array($role->name, $userRole) 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
@endsection