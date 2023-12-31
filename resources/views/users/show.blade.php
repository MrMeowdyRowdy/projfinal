@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Detalles de usuario</h1>
    <div class="lead">

    </div>
    <section class="container mt-4">
        <p>
            CRID: {{ $user->id }}
        </p>
        <p>
            Cédula: {{ $user->nroDocIdentificacion }}
        </p>
        <p>
            Sede: {{ $user->sedeObject->sede }}
        </p>
        <p>
            Apellido: {{ $user->apellido }}
        </p>
        <p>
            Nombre: {{ $user->name }}
        </p>
        <p>
            Teléfono de contacto: {{ $user->tlfContacto }}
        </p>
        <p>
            Correo: {{ $user->email }}
        </p>
        <p>
            Rackspace: {{ $user->emailRackspace }}
        </p>
        <p>
            Tiempo completo: {{ $user->fullTimeObject->fullTime }}
        </p>
        <p>
            Categoría: {{ $user->categoriaObject->categoria }}
        </p>
        <p>
            Horario: {{ $user->horarioObject->detalle }}
        </p>
        <p>
            Username: {{ $user->username }}
        </p>
    </section>

</div>
<section class="mt-4">
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
    <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
</section>
@endsection