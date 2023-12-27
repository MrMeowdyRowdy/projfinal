@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Añadir un tipoRcp</h1>
    <div class="lead">
        Llena los datos acerca del tipo de problema.
    </div>

    <div class="container mt-4">
        <form method="POST" action="{{route('tipoRcps.store')}}">
            @csrf
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de problema</label>
                <input value="{{ old('tipo') }}" type="text" class="form-control" name="tipo"
                    placeholder="Nombre de la empresa bajo la cual se provee el servicio." required>
                @if ($errors->has('tipo'))
                <span class="text-danger text-left">{{ $errors->first('tipo') }}</span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Crear Proveedor</button>
            <a href="{{ route('tipoRcps.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection