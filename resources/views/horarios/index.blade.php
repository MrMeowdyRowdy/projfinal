@extends('layouts.app-master')

@section('content')
    
    <h1 class="mb-3">Lista de Horarios</h1>

    <div class="bg-light p-4 rounded">
        <h1>Lista de Horarios</h1>
        <div class="lead">
            Lista de los distintos horarios existentes
            <a href="{{ route('horarios.create') }}" class="btn btn-primary btn-sm float-right">Crear </a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Hora Inicio</th>
             <th>Hora Fin</th>
             <th width="3%" colspan="3">Acciones</th>
          </tr>
            @foreach ($horarios as $key => $horario)
            <tr>
                <td>{{ $horario->horaInicio }}</td>
                <td>{{ $horario->horaFin }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('horarios.show', $horario->id) }}">Detalles</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('horarios.edit', $horario->id) }}">Editar</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['horarios.destroy', $horario->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $horarios->links() !!}
        </div>

    </div>
@endsection