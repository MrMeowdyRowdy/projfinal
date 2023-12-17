@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Reportar un problema</h1>
    <div class="lead">
        Llena los datos acerca del problema.
    </div>

    <div class="container mt-4">
        <form method="POST" action="">
            @csrf
            <div class="mb-3">
                <label for="llamadaID" class="form-label">ID de la Llamada</label>
                <input value="{{ old('llamadaID') }}" type="number" class="form-control" name="llamadaID"
                    placeholder="Id de la Llamada" required>

                @if ($errors->has('llamadaID'))
                <span class="text-danger text-left">{{ $errors->first('llamadaID') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="interpreterID" class="form-label">Interpreter ID</label>
                <input value="{{ old('interpreterID') }}" type="number" class="form-control" name="interpreterID"
                    placeholder="3XXXXX" required>

                @if ($errors->has('interpreterID'))
                <span class="text-danger text-left">{{ $errors->first('interpreterID') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de problema</label>
                <input value="{{ old('tipo') }}" type="text" class="form-control" name="tipo"
                    placeholder="" required>
                @if ($errors->has('tipoempresaCliente'))
                <span class="text-danger text-left">{{ $errors->first('tipo') }}</span>
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