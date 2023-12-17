@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Detalles de horario</h1>
        <div class="lead">
            
        </div>
        
        <section class="container mt-4">
            <p>
                Hora Inicio: {{ $horario->horaInicio }}
            </p>
            <p>
                Hora Fin: {{ $horario->horaFin }}
            </p>
            <p>
                Detalle: {{ $horario->detalle }}
            </p>
        </section>

    </div>
    <section class="mt-4">
        <a href="{{ route('horarios.edit', $horario->id) }}" class="btn btn-info">Editar</a>
        <a href="{{ route('horarios.index') }}" class="btn btn-default">Atrás</a>
    </section>
@endsection