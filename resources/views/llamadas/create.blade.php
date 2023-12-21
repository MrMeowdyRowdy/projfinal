@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Registrar una llamada</h1>
    <div class="lead">
        Llena los datos de la llamada que acabas de atender.
    </div>

    <div class="container mt-4">
        <form method="POST" action="">
            @csrf
            <div class="mb-3">
                <label for="interpreterID" class="form-label">Interpreter ID</label>
                <input value="{{ old('interpreterID') }}" type="number" class="form-control" name="interpreterID"
                    placeholder="3XXXXX" required>

                @if ($errors->has('interpreterID'))
                <span class="text-danger text-left">{{ $errors->first('interpreterID') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="horaInicio" class="form-label">Hora Inicio</label>
                <input value="{{ old('horaInicio') }}" type="time" class="form-control" name="horaInicio"
                    placeholder="00:00" required>
                @if ($errors->has('horaInicio'))
                <span class="text-danger text-left">{{ $errors->first('horaInicio') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="horaFin" class="form-label">Hora Fin</label>
                <input value="{{ old('horaFin') }}" type="time" class="form-control" name="horaFin" placeholder="00:00"
                    required>
                @if ($errors->has('horaFin'))
                <span class="text-danger text-left">{{ $errors->first('horaFin') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="empresaCliente" class="form-label">Cliente</label>
                <select class="form-control" name="empresaCliente" required>
                    <option value="">Elija la empresa cliente</option>
                    @foreach($empresa_clientes as $empresa_cliente)
                    <option value="{{ $empresa_cliente->id }}" >{{
                        $empresa_cliente->nombre }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('empresaCliente'))
                <span class="text-danger text-left">{{ $errors->first('empresaCliente') }}</span>
                @endif
            </div>empresaCliente
            <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor</label>
                <select class="form-control" name="proveedor" required>
                    <option value="">Elija la empresa bajo la cual has prestado el servicio</option>
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
            <div class="mb-3">
                <label for="lenguaLEP" class="form-label">Lengua del LEP</label>
                <select class="form-control" name="lenguaLEP" required>
                    <option value="">Elige el lenguaje del LEP</option>
                    @foreach($lenguaLEPs as $lenguaLEP)
                    <option value="{{ $lenguaLEP->id }}" >{{
                        $lenguaLEP->lengua }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('lenguaLEP'))
                <span class="text-danger text-left">{{ $errors->first('lenguaLEP') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input value="{{ old('tipo') }}" type="text" class="form-control" name="tipo" placeholder="CSI"
                    required>
                @if ($errors->has('tipo'))
                <span class="text-danger text-left">{{ $errors->first('tipo') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="especializacion" class="form-label">Especializacion</label>
                <input value="{{ old('especializacion') }}" type="text" class="form-control" name="especializacion"
                    placeholder="MED" required>
                @if ($errors->has('especializacion'))
                <span class="text-danger text-left">{{ $errors->first('especializacion') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Registrar llamada</button>
            <a href="{{ route('llamadas.index') }}" class="btn btn-default">Atrás</a>
        </form>
    </div>

</div>
@endsection