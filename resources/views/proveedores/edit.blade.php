@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Editar datos del proveedor</h1>
    <div class="lead">
        Llena los datos acerca del proveedor.
    </div>

    <div class="container mt-4">
    <form method="POST" action="{{ route('proveedors.update', $proveedor->id) }}">
                @method('patch')
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del proveedor</label>
                <input value="{{ $proveedor->nombre }}" type="text" class="form-control" name="nombre"
                    placeholder="Nombre de la empresa bajo la cual se presta el servicio." required>
                @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
                @endif
            </div>
            

            <button type="submit" class="btn btn-primary">Reportar Llamada</button>
            <a href="{{ route('proveedors.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection