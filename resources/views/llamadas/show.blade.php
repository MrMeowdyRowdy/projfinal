@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Detalles de usuario</h1>
    <div class="lead">

    </div>

    <section class="container mt-4">
        <p>
            Interpreter ID: {{ $llamada->interpreterID }}
        </p>
        <p>
            Hora Inicio: {{ $llamada->horaInicio }}
        </p>
        <p>
            Hora Fin: {{ $llamada->horaFin }}
        </p>
        <p>
            Cliente: {{ $llamada->empresaClienteObject->nombre }}
        </p>
        <p>
            Proveedor: {{ $llamada->proveedorObject->nombre }}
        </p>
        <p>
            Lengua LEP: {{ $llamada->lenguaLEPObject->lengua }}
        </p>
        <p>
            Tipo: {{ $llamada->categoriaObject->categoria }}
        </p>
    </section>

</div>
<section class="mt-4">
    <a href="{{ route('llamadas.edit', $llamada->id) }}" class="btn btn-info">Editar</a>
    <a href="{{ route('llamadas.index') }}" class="btn btn-default">Atrás</a>
</section>
@endsection