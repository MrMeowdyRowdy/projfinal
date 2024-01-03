@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Reportar un problema</h1>
    <div class="lead">
        Llena los datos acerca del problema.
    </div>

    <div class="container mt-4">
        <form method="POST" action="{{route('rcps.store')}}">
            @csrf
            <div class="mb-3">
                <label for="llamadaID" class="form-label">ID de la Llamada</label>
                <input value="{{ $llamadaID }}" type="number" class="form-control" name="llamadaID"
                    placeholder="Id de la Llamada" readonly>

                @if ($errors->has('llamadaID'))
                <span class="text-danger text-left">{{ $errors->first('llamadaID') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input value="{{ $fecha }}" type="date" class="form-control" name="fecha"
                    placeholder="Id de la Llamada" readonly>

                @if ($errors->has('fecha'))
                <span class="text-danger text-left">{{ $errors->first('fecha') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de problema</label>
                <select class="form-control" name="tipo" required>
                    <option value="">Elige el tipo de problema de llamada atendida</option>
                    @foreach($tipoRcps as $tipo)
                    <option value="{{ $tipo->id }}">{{
                        $tipo->tipo }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('tipo'))
                <span class="text-danger text-left">{{ $errors->first('tipo') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="catastrofico" class="form-label">Error catastrofico</label>
                <select class="form-control" name="catastrofico" required>
                    <option value="">El error te impidió continuar la llamada?</option>
                    @foreach($catastroficos as $catastrofico)
                    <option value="{{ $catastrofico->id }}">{{
                        $catastrofico->catastrofico }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('catastrofico'))
                <span class="text-danger text-left">{{ $errors->first('catastrofico') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Comentarios</label>
                <input value="{{ old('mensaje') }}" type="text" class="form-control" name="mensaje"
                    placeholder="Explica lo ocurrido" required>
                @if ($errors->has('mensaje'))
                <span class="text-danger text-left">{{ $errors->first('mensaje') }}</span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Reportar Llamada</button>
            <a href="{{ route('rcps.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection