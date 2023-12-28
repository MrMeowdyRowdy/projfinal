@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Añadir una sede</h1>
    <div class="lead">
        Llena los datos acerca de la sede.
    </div>

    <div class="container mt-4">
        <form method="POST" action="{{route('sedes.store')}}">
            @csrf
            <div class="mb-3">
                <label for="sede" class="form-label">Nombre sede</label>
                <input value="{{ old('sede') }}" type="text" class="form-control" name="sede"
                    placeholder="Nombre de la empresa bajo la cual se provee el servicio." required>
                @if ($errors->has('sede'))
                <span class="text-danger text-left">{{ $errors->first('sede') }}</span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Crear sede</button>
            <a href="{{ route('sedes.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection