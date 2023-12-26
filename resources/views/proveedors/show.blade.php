@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Detalles de proveedor</h1>
        <div class="lead">
            
        </div>
        
        <section class="container mt-4">
            <p>
                Proveedor ID: {{ $proveedor->llamadaID }}
            </p>
            <p>
                Nombre del proveedor: {{ $proveedor->nombre }}
            </p>
        </section>

    </div>
    <section class="mt-4">
        <a href="{{ route('proveedors.edit', $proveedor->id) }}" class="btn btn-info">Editar</a>
        <a href="{{ route('proveedors.index') }}" class="btn btn-default">Atrás</a>
    </section>
@endsection