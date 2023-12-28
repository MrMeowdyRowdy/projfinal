@extends('layouts.app-master')

@section('content')
    
    <h1 class="mb-3">Registro de Sedes</h1>

    <div class="bg-light p-4 rounded">
        <h1>Lista de sedes bajo los cuales se da servicio</h1>
        <div class="lead">
            Aquí se encuentra una lista de los sedes bajo los cuales nuestros interpretes dan servicio.
            <a href="{{ route('sedes.create') }}" class="btn btn-primary btn-sm float-right">Crear </a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Sede</th>
             <th width="3%" colspan="3">Acciones</th>
          </tr>
            @foreach ($sedes as $key => $sede)
            <tr>
                <td>{{ $sede->id }}</td>
                <td>{{ $sede->sede }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('sedes.show', $sede->id) }}">Detalles</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('sedes.edit', $sede->id) }}">Editar</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['sedes.destroy', $sede->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $sedes->links() !!}
        </div>

    </div>
@endsection