@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Detalles de la sede</h1>
    <div class="lead">

    </div>

    <section class="container mt-4">
        <p>
            Sede ID: {{ $sede->id }}
        </p>
        <p>
            Sede: {{ $sede->nombre }}
        </p>
    </section>

</div>
<section class="mt-4">
    <a href="{{ route('sedes.edit', $sede->id) }}" class="btn btn-info">Editar</a>
    <a href="{{ route('sedes.index') }}" class="btn btn-default">Atrás</a>
</section>
@endsection