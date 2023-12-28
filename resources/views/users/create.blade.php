@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Add new user</h1>
    <div class="lead">
        Add new user and assign role.
    </div>

    <div class="container mt-4">
        <form method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="mb-3">
                <label for="nroDocIdentificacion" class="form-label">Cédula</label>
                <input value="{{ old('nroDocIdentificacion') }}" type="text" class="form-control" name="nroDocIdentificacion"
                    placeholder="1700000000" required>

                @if ($errors->has('nroDocIdentificacion'))
                <span class="text-danger text-left">{{ $errors->first('nroDocIdentificacion') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="sede" class="form-label">Sede</label>
                <select class="form-control" name="sede" required>
                    <option value="">Sede</option>
                    @foreach($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->sede }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('sede'))
                <span class="text-danger text-left">{{ $errors->first('sede') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Nombre"
                    required>

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="tlfContacto" class="form-label">Teléfono</label>
                <input value="{{ old('tlfContacto') }}" type="text" class="form-control" name="tlfContacto"
                    placeholder="0900000000" required>

                @if ($errors->has('tlfContacto'))
                <span class="text-danger text-left">{{ $errors->first('tlfContacto') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ old('email') }}" type="email" class="form-control" name="email"
                    placeholder="john@doe.com" required>
                @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="emailRackspace" class="form-label">Email Rackspace</label>
                <input value="{{ old('emailRackspace') }}" type="email" class="form-control" name="emailRackspace"
                    placeholder="john@doe.com" required>
                @if ($errors->has('emailRackspace'))
                <span class="text-danger text-left">{{ $errors->first('emailRackspace') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="fullTime" class="form-label">Tipo de empleo</label>
                <select class="form-control" name="fullTime">
                    <option value="">Empleado a tiempo completo</option>
                    @foreach($full_times as $full_time)
                    <option value="{{ $full_time->id }}">{{
                        $full_time->id }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('fullTime'))
                <span class="text-danger text-left">{{ $errors->first('fullTime') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-control" name="categoria" required>
                    <option value="">Categoria</option>
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('categoria'))
                <span class="text-danger text-left">{{ $errors->first('categoria') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="horario" class="form-label">Horario</label>
                <select class="form-control" name="horario" required>
                    <option value="">Horario</option>
                    @foreach($horarios as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                    @endforeach
                </select>
                @if ($errors->has('horario'))
                <span class="text-danger text-left">{{ $errors->first('horario') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input value="{{ old('username') }}" type="text" class="form-control" name="username"
                    placeholder="Username" required>
                @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" name="role" required>
                    <option value="">Select role</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Crear Usuario</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection