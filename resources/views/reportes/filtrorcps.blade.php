@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Reporte de llamadas por cliente</h1>

<div class="bg-light p-4 rounded">
    <h1>Llamadas por Cliente</h1>
    <div class="lead">
        Ingresa los parametros por los cuales deseas realizar las busquedas.
        <div class="mb-3">
            <form method="POST" action="{{route('reportes.conRcp')}}">
                @csrf
                <label for="startdate" class="form-label">Fecha Inicio</label>
                <input value="{{ old('startdate') }}" type="date" class="form-control" name="startdate" placeholder="">
                @if ($errors->has('startdate'))
                <span class="text-danger text-left">{{ $errors->first('startdate') }}</span>
                @endif
                <label for="enddate" class="form-label">Fecha Fin</label>
                <input value="{{ old('enddate') }}" type="date" class="form-control" name="enddate" placeholder="">
                @if ($errors->has('enddate'))
                <span class="text-danger text-left">{{ $errors->first('enddate') }}</span>
                @endif
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-bordered">
        <tr>
            <th width="1%">ID Llamada</th>
            <th width="1%">ID RCP</th>
            <th>Fecha</th>
            <th>Interpreter ID</th>
            <th>Cliente</th>
            <th>Proveedor</th>
            <th>Lengua LEP</th>
            <th>Tipo</th>
        </tr>
        @foreach ($llamadas as $key => $llamada)
        @foreach ($llamada['llamadasArray'] as $llamadaObject)
        <tr>
            <td>{{ $llamadaObject->id }}</td>
            <td>{{ $llamadaObject->idRcp }}</td>
            <td>{{ $llamadaObject->fecha }}</td>
            <td>{{ $llamadaObject->interpreterID }}</td>
            <td>{{ $llamadaObject->empresaClienteObject->nombre }}</td>
            <td>{{ $llamadaObject->proveedorObject->nombre }}</td>
            <td>{{ $llamadaObject->lenguaLEPObject->lengua }}</td>
            <td>{{ $llamadaObject->tipoObject->tipo }}</td>
        </tr>
        @endforeach
        @endforeach
    </table>

</div>
@endsection