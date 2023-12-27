@extends('layouts.app-master')

@section('content')
    
    <h1 class="mb-3">Registro de Proveedores</h1>

    <div class="bg-light p-4 rounded">
        <h1>Tipos de problemas</h1>
        <div class="lead">
            Aquí se encuentra una lista de problemas que podrán ser reportados por interpretes.
            <a href="{{ route('tipoRcps.create') }}" class="btn btn-primary btn-sm float-right">Crear </a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>TIpo de problema</th>
             <th width="3%" colspan="3">Acciones</th>
          </tr>
            @foreach ($tipoRcps as $key => $tipoRcp)
            <tr>
                <td>{{ $tipoRcp->id }}</td>
                <td>{{ $tipoRcp->tipo }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('tipoRcps.show', $tipoRcp->id) }}">Detalles</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('tipoRcps.edit', $tipoRcp->id) }}">Editar</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['tipoRcps.destroy', $tipoRcp->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $tipoRcps->links() !!}
        </div>

    </div>
@endsection