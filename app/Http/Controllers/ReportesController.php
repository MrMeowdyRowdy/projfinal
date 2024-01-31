<?php

namespace App\Http\Controllers;

use App\Models\Catastrofico;
use App\Models\Categoria;
use App\Models\EmpresaCliente;
use App\Models\LenguaLEP;
use App\Models\Llamada;
use App\Models\Proveedor;
use App\Models\Rcp;
use App\Models\Sede;
use App\Models\TipoRcp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\FiltrosController;

class ReportesController extends Controller
{
    /**
     * Display all reportes
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ];
        }

        if ($filters) {
            $llamadasLenguajes = (new DashboardsController)->dashboardLenguajes($filters);
            $llamadasCategorias = (new DashboardsController)->dashboardCategoria($filters);
            $llamadasClientes = (new DashboardsController)->dashboardCliente($filters);
            $llamadasProveedors = (new DashboardsController)->dashboardProveedor($filters);
            $llamadasSedes = (new DashboardsController)->dashboardSede($filters);
            $llamadasProblemas = (new DashboardsController)->dashboardConProblemas($filters);
        } else {
            $llamadasLenguajes = (new DashboardsController)->dashboardLenguajes();
            $llamadasCategorias = (new DashboardsController)->dashboardCategoria();
            $llamadasClientes = (new DashboardsController)->dashboardCliente();
            $llamadasProveedors = (new DashboardsController)->dashboardProveedor();
            $llamadasSedes = (new DashboardsController)->dashboardSede();
            $llamadasProblemas = (new DashboardsController)->dashboardConProblemas();
        }


        return view('reportes.index', [
            'llamadasLenguajes' => $llamadasLenguajes,
            'llamadasCategorias' => $llamadasCategorias,
            'llamadasClientes' => $llamadasClientes,
            'llamadasProveedors' => $llamadasProveedors,
            'llamadasSedes' => $llamadasSedes,
            'llamadasProblemas' => $llamadasProblemas
        ]);
    }

    /**
     * Show form for creating reporte por idioma
     * 
     * @return \Illuminate\Http\Response
     */
    public function porIdioma(Request $request)
    {
        $filters = [];
        $filters['column'] = 'lenguaLEP';
        $filters['value'] = $request->lenguaLEP;
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ];
        }


        if ($filters) {
            $llamadas = (new FiltrosController)->filtrarIdiomas($filters);
        } else {
            $llamadas = (new FiltrosController)->filtrarIdiomas();
        }
        return view('reportes.filtrosidioma', [
            'llamadas' => $llamadas,
            'lenguaLEPs' => LenguaLEP::latest()->get(),
        ]);
    }

    public function porProveedor(Request $request)
    {
        $filters = [];
        $filters['column'] = 'proveedor';
        $filters['value'] = $request->proveedor;
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ];
        }


        if ($filters) {
            $llamadas = (new FiltrosController)->filtrarProveedor($filters);
        } else {
            $llamadas = (new FiltrosController)->filtrarProveedor();
        }

        return view('reportes.filtrosproveedor', [
            'llamadas' => $llamadas,
            'proveedors' => Proveedor::latest()->get(),
        ]);
    }
    
    public function porCategoria(Request $request)
    {
        $filters = [];
        $filters['column'] = 'tipo';
        $filters['value'] = $request->categoria;
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ];
        }


        if ($filters) {
            $llamadas = (new FiltrosController)->filtrarTipo($filters);
        } else {
            $llamadas = (new FiltrosController)->filtrarTipo();
        }

        return view('reportes.filtrostipo', [
            'llamadas' => $llamadas,
            'categorias' => Categoria::latest()->get(),
        ]);
    }

    public function porCliente(Request $request)
    {
        $filters = [];
        $filters['column'] = 'empresaCliente';
        $filters['value'] = $request->empresaCliente;
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ];
        }

        if ($filters) {
            $llamadas = (new FiltrosController)->filtrarCliente($filters);
        } else {
            $llamadas = (new FiltrosController)->filtrarCliente();
        }

        return view('reportes.filtroscliente', [
            'llamadas' => $llamadas,
            'clientes' => EmpresaCliente::latest()->get(),
        ]);
    }

    public function conRcp(Request $request)
    {
        $filters = [];
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ];
        }

        if ($filters) {
            $llamadas = (new FiltrosController)->filtrarLlamadasRcp($filters);
        } else {
            $llamadas = (new FiltrosController)->filtrarLlamadasRcp();
        }

        return view('reportes.filtrorcps', [
            'llamadas' => $llamadas,
        ]);
    }

    public function porSede(Request $request)
    {
        $filters = [];
        $filters['column'] = 'sede';
        $filters['value'] = $request->sede;
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ];
        }


        if ($filters) {
            $llamadas = (new FiltrosController)->filtrarSede($filters);
        } else {
            $llamadas = (new FiltrosController)->filtrarSede();
        }

        return view('reportes.filtrosede', [
            'llamadas' => $llamadas,
            'sedes' => Sede::latest()->get(),
        ]);
    }

}
