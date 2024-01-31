<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\EmpresaCliente;
use App\Models\LenguaLEP;
use App\Models\Proveedor;
use App\Models\Sede;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\FiltrosController;

class ReportesController extends Controller
{
    private DashboardsController $dashboardsController;
    private FiltrosController $filtrosController;

    public function __construct(DashboardsController $dashboardsController,FiltrosController $filtrosController){
        $this->dashboardsController = $dashboardsController;
        $this->filtrosController = $filtrosController;
    }
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
            $llamadasLenguajes = $this->dashboardsController->dashboardLenguajes($filters);
            $llamadasCategorias = $this->dashboardsController->dashboardCategoria($filters);
            $llamadasClientes = $this->dashboardsController->dashboardCliente($filters);
            $llamadasProveedors = $this->dashboardsController->dashboardProveedor($filters);
            $llamadasSedes = $this->dashboardsController->dashboardSede($filters);
            $llamadasProblemas = $this->dashboardsController->dashboardConProblemas($filters);
        } else {
            $llamadasLenguajes = $this->dashboardsController->dashboardLenguajes();
            $llamadasCategorias = $this->dashboardsController->dashboardCategoria();
            $llamadasClientes = $this->dashboardsController->dashboardCliente();
            $llamadasProveedors = $this->dashboardsController->dashboardProveedor();
            $llamadasSedes = $this->dashboardsController->dashboardSede();
            $llamadasProblemas = $this->dashboardsController->dashboardConProblemas();
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
            $llamadas = $this->filtrosController->filtrarIdiomas($filters);
        } else {
            $llamadas = $this->filtrosController->filtrarIdiomas();
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
            $llamadas = $this->filtrosController->filtrarProveedor($filters);
        } else {
            $llamadas = $this->filtrosController->filtrarProveedor();
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
            $llamadas = $this->filtrosController->filtrarTipo($filters);
        } else {
            $llamadas = $this->filtrosController->filtrarTipo();
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
            $llamadas = $this->filtrosController->filtrarCliente($filters);
        } else {
            $llamadas = $this->filtrosController->filtrarCliente();
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
            $llamadas = $this->filtrosController->filtrarLlamadasRcp($filters);
        } else {
            $llamadas = $this->filtrosController->filtrarLlamadasRcp();
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
            $llamadas = $this->filtrosController->filtrarSede($filters);
        } else {
            $llamadas = $this->filtrosController->filtrarSede();
        }

        return view('reportes.filtrosede', [
            'llamadas' => $llamadas,
            'sedes' => Sede::latest()->get(),
        ]);
    }

}
