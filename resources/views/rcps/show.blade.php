@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Detalles de RCP</h1>
        <div class="lead">
            
        </div>
        
        <section class="container mt-4">
            <p>
                Llamada ID: {{ $rcp->llamadaID }}
            </p>
            <p>
                Interpreter ID: {{ $rcp->interpreterID }}
            </p>
            <p>
                Tipo de problema : {{ $rcp->tipo }}
            </p>
            <p>
                Mensaje: {{ $rcp->mensaje }}
            </p>
        </section>

    </div>
    <section class="mt-4">
        <a href="{{ route('rcps.edit', $rcp->id) }}" class="btn btn-info">Editar</a>
        <a href="{{ route('rcps.index') }}" class="btn btn-default">Atrás</a>
    </section>
@endsection