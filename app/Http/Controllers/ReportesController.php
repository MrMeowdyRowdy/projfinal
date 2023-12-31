<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\EmpresaCliente;
use App\Models\LenguaLEP;
use App\Models\Llamada;
use App\Models\Proveedor;
use App\Models\TipoRcp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
                'enddate' => $request->enddate
            ];
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
            $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'llamadas.lenguaLEP', 'tipo')
                ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'lenguaLEP'  (columna bdd) y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'llamadas.lenguaLEP', 'tipo')
                    ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')
                    ->where($filters['column'], $filters['value'])->get();
            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'lenguaLEP, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'llamadas.lenguaLEP', 'tipo')
                    ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }

        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->categoriaObject = Categoria::where('id', $llamada->tipo)->first();
            $llamada->duracion = Carbon::parse($llamada->horaInicio)->diffInMinutes(Carbon::parse($llamada->horaFin));
        }

        $llamadasAgrupadas = [];

        foreach ($llamadas as $llamada) {
            if (array_key_exists($llamada->lenguaLEP, $llamadasAgrupadas)) {
                // Key already exists, update the values
                $llamadasAgrupadas[$llamada->lenguaLEP]['llamadasIdiomaCount'] += 1;
                //Construyes un array u objecto que necesites para agregar a este segundo array
                $llamadasAgrupadas[$llamada->lenguaLEP]['llamadasArray'][] = $llamada;
            } else {
                // Key doesn't exist, create a new entry
                $llamadasAgrupadas[$llamada->lengualenguaLEP] = [
                    'llamadasIdiomaCount' => 1,
                    'lenguajeUsado' => $llamada->lenguaLEP,
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
                'enddate' => $request->enddate
            ];
        }


        if ($filters) {
            $llamadas = $this->filtrarProveedor($filters);
        } else {
            $llamadas = $this->filtrarProveedor();
        }

        return view('reportes.filtrosproveedor', [
            'llamadas' => $llamadas,
            'proveedors' => Proveedor::latest()->get(),
        ]);
    }
    private function filtrarProveedor($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'llamadas.proveedor', 'lenguaLEP', 'tipo')
                ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'proveedor'  (columna bdd) y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'llamadas.proveedor', 'lenguaLEP', 'tipo')
                    ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')
                    ->where($filters['column'], $filters['value'])->get();
            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'proveedor, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'llamadas.proveedor', 'lenguaLEP', 'tipo')
                    ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }

        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->categoriaObject = Categoria::where('id', $llamada->tipo)->first();
            $llamada->duracion = Carbon::parse($llamada->horaInicio)->diffInMinutes(Carbon::parse($llamada->horaFin));
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
            $llamadas = $this->filtrarTipo($filters);
        } else {
            $llamadas = $this->filtrarTipo();
        }

        return view('reportes.filtrostipo', [
            'llamadas' => $llamadas,
            'categorias' => Categoria::latest()->get(),
        ]);
    }

    private function filtrarTipo($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'lenguaLEP', 'llamadas.tipo')
                ->join('categorias', 'llamadas.tipo', '=', 'categorias.id')
                ->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'categoria'  (columna bdd) y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'lenguaLEP', 'llamadas.tipo')
                    ->join('categorias', 'llamadas.tipo', '=', 'categorias.id')
                    ->where($filters['column'], $filters['value'])->get();
            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'categoria, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'lenguaLEP', 'llamadas.tipo')
                    ->join('categorias', 'llamadas.tipo', '=', 'categorias.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }
        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->categoriaObject = Categoria::where('id', $llamada->tipo)->first();      
            $llamada->duracion = Carbon::parse($llamada->horaInicio)->diffInMinutes(Carbon::parse($llamada->horaFin));
        }

        $llamadasAgrupadas = [];
        foreach ($llamadas as $llamada) {
            if (array_key_exists($llamada->tipo, $llamadasAgrupadas)) {
                // Key already exists, update the values
                $llamadasAgrupadas[$llamada->tipo]['llamadasCategoriaCount'] += 1;
                //Construyes un array u objecto que necesites para agregar a este segundo array
                $llamadasAgrupadas[$llamada->tipo]['llamadasArray'][] = $llamada;
            } else {
                // Key doesn't exist, create a new entry
                $llamadasAgrupadas[$llamada->tipo] = [
                    'llamadasCategoriaCount' => 1,
                    'categoriaUsado' => $llamada->tipo,
                    'llamadasArray' => [$llamada]
                ];
            }
        }
        return ($llamadasAgrupadas);
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
            $llamadas = $this->filtrarCliente($filters);
        } else {
            $llamadas = $this->filtrarCliente();
        }

        return view('reportes.filtroscliente', [
            'llamadas' => $llamadas,
            'clientes' => EmpresaCliente::latest()->get(),
        ]);
    }

    private function filtrarCliente($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'llamadas.lenguaLEP', 'tipo')
                ->join('empresa_clientes', 'llamadas.empresaCliente', '=', 'empresa_clientes.id')->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'empresaCliente'  (columna bdd) y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'llamadas.lenguaLEP', 'tipo')
                    ->join('empresa_clientes', 'llamadas.empresaCliente', '=', 'empresa_clientes.id')
                    ->where($filters['column'], $filters['value'])->get();

            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 
                //'empresaCliente, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'llamadas.lenguaLEP', 'tipo')
                    ->join('empresa_clientes', 'llamadas.empresaCliente', '=', 'empresa_clientes.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }

        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->categoriaObject = Categoria::where('id', $llamada->tipo)->first();
            $llamada->duracion = Carbon::parse($llamada->horaInicio)->diffInMinutes(Carbon::parse($llamada->horaFin));
        }

        $llamadasAgrupadas = [];

        foreach ($llamadas as $llamada) {
            if (array_key_exists($llamada->empresaCliente, $llamadasAgrupadas)) {
                // Key already exists, update the values
                $llamadasAgrupadas[$llamada->empresaCliente]['llamadasClienteCount'] += 1;
                //Construyes un array u objecto que necesites para agregar a este segundo array
                $llamadasAgrupadas[$llamada->empresaCliente]['llamadasArray'][] = $llamada;
            } else {
                // Key doesn't exist, create a new entry
                $llamadasAgrupadas[$llamada->empresaCliente] = [
                    'llamadasClienteCount' => 1,
                    'ClienteUsado' => $llamada->empresaCliente,
                    'llamadasArray' => [$llamada]
                ];
            }
        }
        return ($llamadasAgrupadas);
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
            $llamadas = $this->filtrarLlamadasRcp($filters);
        } else {
            $llamadas = $this->filtrarLlamadasRcp();
        }

        return view('reportes.filtrorcps', [
            'llamadas' => $llamadas,
        ]);
    }

    private function filtrarLlamadasRcp($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('llamadas.id', 'rcps.id as idRcp', 'llamadas.interpreterID', 'fecha', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo_rcps.id as tipo')
                ->join('rcps', 'llamadas.id', '=', 'rcps.llamadaID')
                ->join('tipo_rcps', 'rcps.tipo', '=', 'tipo_rcps.id')
                ->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'empresaCliente'  (columna bdd) y relaciones
                $llamadas = Llamada::select('llamadas.id', 'rcps.id as idRcp', 'llamadas.interpreterID', 'fecha', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo_rcps.id as tipo')
                    ->join('rcps', 'llamadas.id', '=', 'rcps.llamadaID')
                    ->join('tipo_rcps', 'rcps.tipo', '=', 'tipo_rcps.id')
                    ->where($filters['column'], $filters['value'])->get();

            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 
                //'empresaCliente, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('llamadas.id', 'rcps.id as idRcp', 'llamadas.interpreterID', 'fecha', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo_rcps.id as tipo')
                    ->join('rcps', 'llamadas.id', '=', 'rcps.llamadaID')
                    ->join('tipo_rcps', 'rcps.tipo', '=', 'tipo_rcps.id')
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }

        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->tipoObject = TipoRcp::where('id', $llamada->tipo)->first();
        }

        $llamadasAgrupadas = [];

        foreach ($llamadas as $llamada) {
            if (array_key_exists($llamada->id, $llamadasAgrupadas)) {
                // Key already exists, update the values
                $llamadasAgrupadas[$llamada->id]['llamadasRcpCount'] += 1;
                //Construyes un array u objecto que necesites para agregar a este segundo array
                $llamadasAgrupadas[$llamada->id]['llamadasArray'][] = $llamada;
            } else {
                // Key doesn't exist, create a new entry
                $llamadasAgrupadas[$llamada->empresaCliente] = [
                    'llamadasRcpCount' => 1,
                    'IdUsado' => $llamada->id,
                    'llamadasArray' => [$llamada]
                ];
            }
        }
        return ($llamadasAgrupadas);
    }

}
