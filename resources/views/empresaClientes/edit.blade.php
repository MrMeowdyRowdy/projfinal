@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Editar datos del empresaCliente</h1>
    <div class="lead">
        Llena los datos acerca del empresaCliente.
    </div>

    <div class="container mt-4">
    <form method="POST" action="{{ route('empresaClientes.update', $empresaCliente->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la empresa Cliente</label>
                <input value="{{ $empresaCliente->nombre }}" type="text" class="form-control" name="nombre"
                    placeholder="Nombre de la empresa cliente." required>
                @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Ubicación</label>
                <input value="{{ $empresaCliente->estado }}" type="text" class="form-control" name="estado"
                    placeholder="Estado de la empresa cliente." required>
                @if ($errors->has('estado'))
                <span class="text-danger text-left">{{ $errors->first('estado') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('empresaClientes.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection