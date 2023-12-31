@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Registro de Llamadas</h1>

<div class="bg-light p-4 rounded">
    <h1>Llamadas</h1>
    <div class="lead">
        Revisa las llamadas registradas aquí.
        <a href="{{ route('llamadas.create') }}" class="btn btn-primary btn-sm float-right">Registrar Llamada</a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-bordered">
        <tr>
            <th width="1%">No</th>
            <th>Fecha</th>
            <th>Interpreter ID</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Cliente</th>
            <th>Proveedor</th>
            <th>Lengua LEP</th>
            <th>Tipo</th>
            <th width="10%" colspan="4">Acciones</th>
        </tr>
        @foreach ($llamadas as $key => $llamada)
        <tr>
            <td>{{ $llamada->id }}</td>
            <td>{{ $llamada->fecha }}</td>
            <td>{{ $llamada->interpreterID }}</td>
            <td>{{ $llamada->horaInicio }}</td>
            <td>{{ $llamada->horaFin }}</td>
            <td>{{ $llamada->empresaClienteObject->nombre }}</td>
            <td>{{ $llamada->proveedorObject->nombre }}</td>
            <td>{{ $llamada->lenguaLEPObject->lengua }}</td>
            <td>{{ $llamada->categoriaObject->categoria }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('llamadas.show', $llamada->id) }}">Detalles</a>
            </td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ route('llamadas.edit', $llamada->id) }}">Editar</a>
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE','route' => ['llamadas.destroy',
                $llamada->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}

            </td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ route('rcps.create', ['id'=>$llamada->id]) }}">RCP</a>
            </td>

        </tr>
        @endforeach
    </table>
    @auth
        @role('TeamLeader')       
    <div class="d-flex">
        {!! $llamadas->links() !!}
    </div>
    @endrole
    @endauth

</div>
@endsection