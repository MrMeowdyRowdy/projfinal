@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Detalles de tipoRcp</h1>
    <div class="lead">

    </div>

    <section class="container mt-4">
        <p>
            Tipo ID: {{ $tipoRcp->id }}
        </p>
        <p>
            Tipo de Problema: {{ $tipoRcp->nombre }}
        </p>
    </section>

</div>
<section class="mt-4">
    <a href="{{ route('tipoRcps.edit', $tipoRcp->id) }}" class="btn btn-info">Editar</a>
    <a href="{{ route('tipoRcps.index') }}" class="btn btn-default">Atrás</a>
</section>
@endsection