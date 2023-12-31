@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Interpretia - Manejo de usuarios</h1>

<div class="bg-light p-4 rounded">
    <h1>Lista de usuarios</h1>
    <div class="lead">
        Maneja usuarios aquí.
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Añadir usuario</a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">CRID</th>
                <th scope="col">Sede</th>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">Rackspace</th>
                <th scope="col">FullTime</th>
                <th scope="col">Categoria</th>
                <th scope="col" width="10%">Rol</th>
                <th scope="col" width="1%" colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->sedeObject->sede }}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->emailRackspace }}</td>
                <td>{{ $user->fullTimeObject->fullTime }}</td>
                <td>{{ $user->categoriaObject->categoria  }}</td>
                <td>
                    @foreach($user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',
                    $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $users->links() !!}
    </div>

</div>
@endsection