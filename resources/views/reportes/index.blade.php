@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Registro de Proveedores</h1>

<div class="bg-light p-4 rounded">
    <h1>Reporteria y busqueda</h1>
    <div class="lead">
        Aquí podrás en un vistazo conocer las estadísticas de llamadas.
    </div>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>
    <a class="btn btn-primary" href="{{ route('reportes.porIdioma') }}">Filtrar por Idioma</a>
    <a class="btn btn-primary" href="{{ route('reportes.porCategoria') }}">Filtrar por Categoría</a>
    <a class="btn btn-primary" href="{{ route('reportes.porCliente') }}">Filtrar por Cliente</a>
    <a class="btn btn-primary" href="{{ route('reportes.porProveedor') }}">Filtrar por Proveedor</a>
    <a class="btn btn-primary" href="{{ route('reportes.conRcp') }}">Llamadas Reportadas</a>
</div>
@endsection