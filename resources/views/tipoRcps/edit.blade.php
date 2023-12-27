@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Editar datos del tipoRcp</h1>
    <div class="lead">
        Llena los datos acerca del tipo de problema.
    </div>

    <div class="container mt-4">
    <form method="POST" action="{{ route('tipoRcps.update', $tipoRcp->id) }}">
                @method('patch')
            @csrf
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de problema</label>
                <input value="{{ $tipoRcp->nombre }}" type="text" class="form-control" name="tipo"
                    placeholder="Nombre de la empresa bajo la cual se provee el servicio." required>
                @if ($errors->has('tipo'))
                <span class="text-danger text-left">{{ $errors->first('tipo') }}</span>
                @endif
            </div>
            

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('tipoRcps.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection