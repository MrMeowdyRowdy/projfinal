@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>{{ ucfirst($role->name) }} Role</h1>
    <div class="lead">

    </div>

    <div class="container mt-4">

        <h3>Permisos asignados</h3>

        <table class="table table-striped">
            <thead>
                <th scope="col" width="20%">Nombre</th>
                <th scope="col" width="1%">Proteccion</th>
            </thead>

            @foreach($rolePermissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
            </tr>
            @endforeach
        </table>
    </div>

</div>
<div class="mt-4">
    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Editar</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default">Atrás</a>
</div>
@endsection