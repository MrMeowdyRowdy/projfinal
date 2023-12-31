@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Editar datos de la sede</h1>
    <div class="lead">
        Llena los datos acerca de la sede.
    </div>

    <div class="container mt-4">
        <form method="POST" action="{{ route('sedes.update', $sede->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="sede" class="form-label">Nombre del sede</label>
                <input value="{{ $sede->sede }}" type="text" class="form-control" name="sede"
                    placeholder="Nombre de la empresa bajo la cual se presta el servicio." required>
                @if ($errors->has('sede'))
                <span class="text-danger text-left">{{ $errors->first('sede') }}</span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('sedes.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection