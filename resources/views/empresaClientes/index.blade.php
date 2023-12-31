@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Registro de Proveedores</h1>

<div class="bg-light p-4 rounded">
    <h1>Lista de clientes a los cuales se ofrece servicios</h1>
    <div class="lead">
        Aquí se encuentra una lista de los clientes a los cuales nuestros interpretes dan servicio.
        <a href="{{ route('empresaClientes.create') }}" class="btn btn-primary btn-sm float-right">Crear </a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-bordered">
        <tr>
            <th width="1%">No</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th width="3%" colspan="3">Acciones</th>
        </tr>
        @foreach ($empresaClientes as $key => $empresaCliente)
        <tr>
            <td>{{ $empresaCliente->id }}</td>
            <td>{{ $empresaCliente->nombre }}</td>
            <td>{{ $empresaCliente->estado }}</td>
            <td>
                <a class="btn btn-info btn-sm"
                    href="{{ route('empresaClientes.show', $empresaCliente->id) }}">Detalles</a>
            </td>
            <td>
                <a class="btn btn-primary btn-sm"
                    href="{{ route('empresaClientes.edit', $empresaCliente->id) }}">Editar</a>
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE','route' => ['empresaClientes.destroy',
                $empresaCliente->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex">
        {!! $empresaClientes->links() !!}
    </div>

</div>
@endsection