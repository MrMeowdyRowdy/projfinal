@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Detalles del Cliente</h1>
        <div class="lead">
            
        </div>
        
        <section class="container mt-4">
            <p>
                Cliente ID: {{ $empresaCliente->id }}
            </p>
            <p>
                Nombre del cliente: {{ $empresaCliente->nombre }}
            </p>
            <p>
                Estado del cliente: {{ $empresaCliente->estado }}
            </p>
        </section>

    </div>
    <section class="mt-4">
        <a href="{{ route('empresaClientes.edit', $empresaCliente->id) }}" class="btn btn-info">Editar</a>
        <a href="{{ route('empresaClientes.index') }}" class="btn btn-default">Atrás</a>
    </section>
@endsection