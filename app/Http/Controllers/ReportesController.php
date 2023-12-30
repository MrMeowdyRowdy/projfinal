<?php

namespace App\Http\Controllers;

use App\Models\LenguaLEP;
use App\Models\Llamada;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    /**
     * Display all reportes
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reportes.index');
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
                'enddate' => $request->enddate];
        }


        if ($filters) {
            $llamadas = $this->filtrarIdiomas($filters);
        } else {
            $llamadas = $this->filtrarIdiomas();
        }

        return view('reportes.filtrosidioma', [
            'llamadas' => $llamadas,
            'lenguaLEPs' => LenguaLEP::latest()->get(),
        ]);
    }

    private function filtrarIdiomas($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('*')
                ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'lenguaLEP'  (columna bdd) y relaciones
                $llamadas = Llamada::select('*')
                    ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')->where($filters['column'], $filters['value'])->get();
            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'lenguaLEP, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('*')
                    ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')->where($filters['column'], $filters['value'])->whereBetween('llamadas.fecha',[$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }

        $llamadasAgrupadas = [];
        foreach ($llamadas as $llamada) {
            if (array_key_exists($llamada->lengua, $llamadasAgrupadas)) {
                // Key already exists, update the values
                $llamadasAgrupadas[$llamada->lengua]['llamadasIdiomaCount'] += 1;
                //Construyes un array u objecto que necesites para agregar a este segundo array
                $llamadasAgrupadas[$llamada->lengua]['llamadasArray'][] = $llamada;
            } else {
                // Key doesn't exist, create a new entry
                $llamadasAgrupadas[$llamada->lengua] = [
                    'llamadasIdiomaCount' => 1,
                    'lenguajeUsado' => $llamada->lengua,
                    'llamadasArray' => [$llamada]
                ];
            }
        }

        return ($llamadasAgrupadas);
    }

    public function porProveedor(Request $request)
    {
        $filters = [];
        $filters['column'] = 'proveedor';
        $filters['value'] = $request->proveedor;
        if ($request->startdate !== null && $request->enddate !== null) {
            $filters['dates'] = [
                'startdate' => $request->startdate,
                'enddate' => $request->enddate];
        }


        if ($filters) {
            $llamadas = $this->filtrarProveedor($filters);
        } else {
            $llamadas = $this->filtrarProveedor();
        }

        return view('reportes.filrosproveedor', [
            'llamadas' => $llamadas,
            'proveedors' => Proveedor::latest()->get(),
        ]);
    }
    private function filtrarProveedor($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('*')
                ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'proveedor'  (columna bdd) y relaciones
                $llamadas = Llamada::select('*')
                    ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')->where($filters['column'], $filters['value'])->get();
            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'proveedor, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('*')
                    ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')->where($filters['column'], $filters['value'])->whereBetween('llamadas.fecha',[$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }

        $llamadasAgrupadas = [];
        foreach ($llamadas as $llamada) {
            if (array_key_exists($llamada->proveedor, $llamadasAgrupadas)) {
                // Key already exists, update the values
                $llamadasAgrupadas[$llamada->proveedor]['llamadasProveedorCount'] += 1;
                //Construyes un array u objecto que necesites para agregar a este segundo array
                $llamadasAgrupadas[$llamada->proveedor]['llamadasArray'][] = $llamada;
            } else {
                // Key doesn't exist, create a new entry
                $llamadasAgrupadas[$llamada->proveedor] = [
                    'llamadasProveedorCount' => 1,
                    'proveedorUsado' => $llamada->proveedor,
                    'llamadasArray' => [$llamada]
                ];
            }
        }
        return ($llamadasAgrupadas);
    }


}
