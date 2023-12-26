@extends('layouts.app-master')

@section('content')
    
    <h1 class="mb-3">Registro de Proveedores</h1>

    <div class="bg-light p-4 rounded">
        <h1>Lista de proveedores bajo los cuales se da servicio</h1>
        <div class="lead">
            Aquí se encuentra una lista de los proveedores bajo los cuales nuestros interpretes dan servicio.
            <a href="{{ route('proveedors.create') }}" class="btn btn-primary btn-sm float-right">Crear </a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Nombre</th>
             <th width="3%" colspan="3">Acciones</th>
          </tr>
            @foreach ($proveedors as $key => $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('proveedors.show', $proveedor->id) }}">Detalles</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('proveedors.edit', $proveedor->id) }}">Editar</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['proveedors.destroy', $proveedor->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $proveedors->links() !!}
        </div>

    </div>
@endsection