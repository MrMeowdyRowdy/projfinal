@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Crear un horario</h1>
    <div class="lead">
        Ingresa los datos sobre el horario.
    </div>

    <div class="container mt-4">
        <form method="POST" action="{{route('horarios.store')}}">
            @csrf
            <div class="mb-3">
                <label for="horaInicio" class="form-label">Hora Inicio</label>
                <input value="{{ old('horaInicio') }}" type="time" class="form-control" name="horaInicio"
                    placeholder="00:00" required>
                @if ($errors->has('horaInicio'))
                <span class="text-danger text-left">{{ $errors->first('horaInicio') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="horaFin" class="form-label">Hora Fin</label>
                <input value="{{ old('horaFin') }}" type="time" class="form-control" name="horaFin" placeholder="00:00"
                    required>
                @if ($errors->has('horaFin'))
                <span class="text-danger text-left">{{ $errors->first('horaFin') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="detalle" class="form-label">Detalle</label>
                <input value="{{ old('detalle') }}" type="text" class="form-control" name="detalle"
                    placeholder="Ingrese las horas a manera de texto" required>
                @if ($errors->has('detalle'))
                <span class="text-danger text-left">{{ $errors->first('detalle') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">crear horario</button>
            <a href="{{ route('horarios.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection