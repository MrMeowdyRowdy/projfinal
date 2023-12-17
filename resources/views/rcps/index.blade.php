@extends('layouts.app-master')

@section('content')
    
    <h1 class="mb-3">Registro de Roles</h1>

    <div class="bg-light p-4 rounded">
        <h1>Report Call Problem</h1>
        <div class="lead">
            Reporta distintos problemas que puedan surgir durante llamadas.
            <a href="{{ route('rcps.create') }}" class="btn btn-primary btn-sm float-right">Crear </a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Id Llamada</th>
             <th>Interpreter ID</th>
             <th>Tipo</th>
             <th width="3%" colspan="3">Acciones</th>
          </tr>
            @foreach ($rcps as $key => $rcp)
            <tr>
                <td>{{ $rcp->id }}</td>
                <td>{{ $rcp->llamadaID }}</td>
                <td>{{ $rcp->interpreterID }}</td>
                <td>{{ $rcp->tipo}}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('rcps.show', $rcp->id) }}">Detalles</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('rcps.edit', $rcp->id) }}">Editar</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['rcps.destroy', $rcp->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $rcps->links() !!}
        </div>

    </div>
@endsection