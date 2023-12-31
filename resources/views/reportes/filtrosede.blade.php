@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Reporte de llamadas por sede</h1>

<div class="bg-light p-4 rounded">
    <h1>Llamadas por Cliente</h1>
    <div class="lead">
        Ingresa los parametros por los cuales deseas realizar las busquedas.
        <div class="mb-3">
            <form method="POST" action="{{route('reportes.porSede')}}">
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
                    <label for="sede" class="form-label">Sede que atendió la llamada</label>
                    <select class="form-control" name="sede" required>
                        <option value="">Elige el sede de la llamada</option>
                        @foreach($sedes as $sede)
                        <option value="{{ $sede->id }}">{{
                            $sede->sede}}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('sede'))
                    <span class="text-danger text-left">{{ $errors->first('sede') }}</span>
                    @endif
                </div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>
    @foreach ($llamadas as $key => $llamada)
    <p>El total de llamadas para el sede es de {{ $llamada['llamadasSedeCount'] }}</p>
    @endforeach
    <table class="table table-bordered">
    <tr>
            <th width="1%">ID Llamada</th>
            <th>Fecha</th>
            <th>Sede</th>
            <th>Interpreter ID</th>
            <th>Hora Inicio</th>
            <th>Duración minutos</th>
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
            <td>{{ $llamadaObject->sedeObject->sede }}</td>
            <td>{{ $llamadaObject->interpreterID }}</td>
            <td>{{ $llamadaObject->horaInicio }}</td>
            <td>{{ $llamadaObject->duracion }}</td>
            <td>{{ $llamadaObject->empresaClienteObject->nombre }}</td>
            <td>{{ $llamadaObject->proveedorObject->nombre }}</td>
            <td>{{ $llamadaObject->lenguaLEPObject->lengua }}</td>
            <td>{{ $llamadaObject->categoriaObject->categoria }}</td>
        </tr>
        @endforeach
        @endforeach
    </table>

</div>
@endsection