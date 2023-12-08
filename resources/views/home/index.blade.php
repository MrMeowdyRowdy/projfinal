@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Solo usuarios autenticados pueden ver esta sección</p>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Esta seccion solo pueden ver usuarios no autenticados</p>
        @endguest
    </div>
@endsection