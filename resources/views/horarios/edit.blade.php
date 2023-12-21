@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Actualizar un horario</h1>
    <div class="lead">
        Modifica los datos sobre el horario.
    </div>

    <div class="container mt-4">
        <form method="post" action="{{ route('horarios.update', $horario->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="horaInicio" class="form-label">Hora Inicio</label>
                <input value="{{ $horario->horaInicio }}" type="time" class="form-control" name="horaInicio"
                    placeholder="00:00" required>
                @if ($errors->has('horaInicio'))
                <span class="text-danger text-left">{{ $errors->first('horaInicio') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="horaFin" class="form-label">Hora Fin</label>
                <input value="{{ $horario->horaFin }}" type="time" class="form-control" name="horaFin" placeholder="00:00"
                    required>
                @if ($errors->has('horaFin'))
                <span class="text-danger text-left">{{ $errors->first('horaFin') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="detalle" class="form-label">Detalle</label>
                <input value="{{ $horario->detalle }}" type="text" class="form-control" name="detalle"
                    placeholder="SPA" required>
                @if ($errors->has('detalle'))
                <span class="text-danger text-left">{{ $errors->first('detalle') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Actualizar horario</button>
            <a href="{{ route('horarios.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection