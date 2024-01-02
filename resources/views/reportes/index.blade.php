@extends('layouts.app-master')

@section('content')

<h1 class="mb-3">Registro de Proveedores</h1>

<div class="bg-light p-4 rounded">
    <h1>Reporteria y busqueda</h1>
    <div class="lead">
        Aquí podrás en un vistazo conocer las estadísticas de llamadas.
    </div>
    <div class="mb-3">
        <form method="POST" action="{{route('reportes.index')}}">
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
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>
    
   
    <a class="btn btn-primary" href="{{ route('reportes.conRcp') }}">Llamadas Reportadas</a>

    <section>
        <div>
            <canvas id="idiomasChart"></canvas>
            <a class="btn btn-primary" href="{{ route('reportes.porIdioma') }}">Filtrar por Idioma</a>
        </div>
        <div>
            <canvas id="categoriasChart"></canvas>
            <a class="btn btn-primary" href="{{ route('reportes.porCategoria') }}">Filtrar por Categoria</a>
        </div>
        <div>
            <canvas id="clientesChart"></canvas>
            <a class="btn btn-primary" href="{{ route('reportes.porCliente') }}">Filtrar por Cliente</a>
        </div>
        <div>
            <canvas id="proveedorsChart"></canvas>
            <a class="btn btn-primary" href="{{ route('reportes.porProveedor') }}">Filtrar por Proveedor</a>
        </div>
        <div>
            <canvas id="sedesChart"></canvas>
            <a class="btn btn-primary" href="{{ route('reportes.porSede') }}">Filtrar por Sede</a>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const llamadasIdioma = @json($llamadasLenguajes);
    const ctxsIdioma = document.getElementById('idiomasChart').getContext('2d');
    const labelsIdioma = llamadasIdioma.map(item => item.lenguaLEP);
    const backgroundColorsIdioma = Array.from({ length: llamadasIdioma.length }, () => generateRandomColor());
    const dataIdiomas = llamadasIdioma.map(item => item.count);
    const dataIdi = {
        labels: labelsIdioma,
        datasets: [{
            label: 'Conteo de llamadas',
            data: dataIdiomas,
            backgroundColor: backgroundColorsIdioma,
            hoverOffset: 4
        }]
    };

    const configIdiomas = {
        type: 'doughnut',
        data: dataIdi,
        options: {
            responsive: true,
        },
    };

    function generateRandomColor() {
        const randomColor = () => Math.floor(Math.random() * 256);
        return `rgba(${randomColor()}, ${randomColor()}, ${randomColor()}, 0.6)`;
    }

    const idiomasChart = new Chart(ctxsIdioma, configIdiomas);

    const llamadasCategorias = @json($llamadasCategorias);
    const ctxsCat = document.getElementById('categoriasChart').getContext('2d');
    const labelsCat = llamadasCategorias.map(item => item.tipo);
    const backgroundColorsCat = Array.from({ length: llamadasCategorias.length }, () => generateRandomColor());
    const dataCategorias = llamadasCategorias.map(item => item.count);
    const dataCat = {
        labels: labelsCat,
        datasets: [{
            label: 'Conteo de llamadas',
            data: dataCategorias,
            backgroundColor: backgroundColorsCat,
            hoverOffset: 4
        }]
    };
    const configCat = {
        type: 'doughnut',
        data: dataCat,
        options: {
            responsive: true,
        },
    };

    const categoriasChart = new Chart(ctxsCat, configCat);

    const llamadasClientes = @json($llamadasClientes);
    const ctxsCli = document.getElementById('clientesChart').getContext('2d');
    const labelsCli = llamadasClientes.map(item => item.empresaCliente);
    const backgroundColorsCli = Array.from({ length: llamadasClientes.length }, () => generateRandomColor());
    const dataClientes = llamadasClientes.map(item => item.count);
    const dataCli = {
        labels: labelsCli,
        datasets: [{
            label: 'Conteo de Llamadas',
            data: dataClientes,
            backgroundColor: backgroundColorsCli,
            hoverOffset: 4
        }]
    };
    const configCli = {
        type: 'bar',
        data: dataCli,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },

    };

    const clientesChart = new Chart(ctxsCli, configCli);

    const llamadasProveedors = @json($llamadasProveedors);
    const ctxsPro = document.getElementById('proveedorsChart').getContext('2d');
    const labelsPro = llamadasProveedors.map(item => item.proveedor);
    const backgroundColorsPro = Array.from({ length: llamadasProveedors.length }, () => generateRandomColor());
    const dataProveedors = llamadasProveedors.map(item => item.count);
    const dataPro = {
        labels: labelsPro,
        datasets: [{
            label: 'Conteo de llamadas',
            data: dataProveedors,
            backgroundColor: backgroundColorsPro,
            hoverOffset: 4
        }]
    };
    const configPro = {
        type: 'doughnut',
        data: dataPro,
        options: {
            responsive: true,
        },
    };

    const proveedorsChart = new Chart(ctxsPro, configPro);

    const llamadasSedes = @json($llamadasSedes);
    const ctxsSed = document.getElementById('sedesChart').getContext('2d');
    const labelsSed = llamadasSedes.map(item => item.sede);
    const backgroundColorsSed = Array.from({ length: llamadasSedes.length }, () => generateRandomColor());
    const dataSedes = llamadasSedes.map(item => item.count);
    const dataSed = {
        labels: labelsSed,
        datasets: [{
            label: 'Conteo de llamadas',
            data: dataSedes,
            backgroundColor: backgroundColorsSed,
            hoverOffset: 4
        }]
    };
    const configSed = {
        type: 'doughnut',
        data: dataSed,
        options: {
            responsive: true,
        },
    };

    const sedesChart = new Chart(ctxsSed, configSed);
</script>
@endsection