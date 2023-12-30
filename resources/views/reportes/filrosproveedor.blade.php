@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Reporte de llamadas por idioma</h1>

<div class="bg-light p-4 rounded">
    <h1>Llamadas por Proveedor</h1>
    <div class="lead">
        Ingresa los parametros por los cuales deseas realizar las busquedas.
        <div class="mb-3">
            <form method="POST" action="{{route('reportes.porProveedor')}}">
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
                <div class="mb-3">
                    <label for="proveedor" class="form-label">Proveedor</label>
                    <select class="form-control" name="proveedor" required>
                        <option value="">Elige el proveedor</option>
                        @foreach($proveedors as $proveedor)
                        <option value="{{ $proveedor->id }}">{{
                            $proveedor->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('proveedor'))
                    <span class="text-danger text-left">{{ $errors->first('proveedor') }}</span>
                    @endif
                </div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
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
        </tr>
        @foreach ($llamadas as $key => $llamada)
        @foreach ($llamada['llamadasArray'] as $llamadaObject)
        <tr>
            <td>{{ $llamadaObject->id }}</td>
            <td>{{ $llamadaObject->fecha }}</td>
            <td>{{ $llamadaObject->interpreterID }}</td>
            <td>{{ $llamadaObject->horaInicio }}</td>
            <td>{{ $llamadaObject->horaFin }}</td>
            <td>{{ $llamadaObject->empresaCliente }}</td>
            <td>{{ $llamadaObject->proveedor }}</td>
            <td>{{ $llamadaObject->lenguaLEP }}</td>
            <td>{{ $llamadaObject->tipo }}</td>
        </tr>
        @endforeach
        @endforeach
    </table>

</div>
@endsection