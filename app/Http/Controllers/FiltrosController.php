<?php

namespace App\Http\Controllers;

use App\Models\Catastrofico;
use App\Models\Categoria;
use App\Models\EmpresaCliente;
use App\Models\LenguaLEP;
use App\Models\Llamada;
use App\Models\Proveedor;
use App\Models\Sede;
use App\Models\TipoRcp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FiltrosController extends Controller
{
    public function filtrarIdiomas($filters = null)
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

    public function filtrarProveedor($filters = null)
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

    public function filtrarTipo($filters = null)
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

    public function filtrarCliente($filters = null)
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

    public function filtrarLlamadasRcp($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('llamadas.id', 'rcps.id as idRcp', 'llamadas.interpreterID', 'llamadas.fecha', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo_rcps.id as tipo', 'catastroficos.id as catastroficoID')
                ->join('rcps', 'llamadas.id', '=', 'rcps.llamadaID')
                ->join('tipo_rcps', 'rcps.tipo', '=', 'tipo_rcps.id')
                ->join('catastroficos', 'rcps.catastrofico', '=', 'catastroficos.id')
                ->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'empresaCliente'  (columna bdd) y relaciones
                $llamadas = Llamada::select('llamadas.id', 'rcps.id as idRcp', 'llamadas.interpreterID', 'llamadas.fecha', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo_rcps.id as tipo', 'catastroficos.id as catastroficoID')
                    ->join('rcps', 'llamadas.id', '=', 'rcps.llamadaID')
                    ->join('tipo_rcps', 'rcps.tipo', '=', 'tipo_rcps.id')
                    ->join('catastroficos', 'rcps.catastrofico', '=', 'catastroficos.id')
                    ->where($filters['column'], $filters['value'])->get();

            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 
                //'empresaCliente, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('llamadas.id', 'rcps.id as idRcp', 'llamadas.interpreterID', 'llamadas.fecha', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo_rcps.id as tipo', 'catastroficos.id as catastroficoID')
                    ->join('rcps', 'llamadas.id', '=', 'rcps.llamadaID')
                    ->join('tipo_rcps', 'rcps.tipo', '=', 'tipo_rcps.id')
                    ->join('catastroficos', 'rcps.catastrofico', '=', 'catastroficos.id')
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }

        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->tipoObject = TipoRcp::where('id', $llamada->tipo)->first();
            $llamada->catastroficoObject = Catastrofico::where('id', $llamada->catastroficoID)->first();
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
                $llamadasAgrupadas[$llamada->tipo] = [
                    'llamadasRcpCount' => 1,
                    'tipoUsado' => $llamada->tipoObject->tipo,
                    'llamadasArray' => [$llamada]
                ];
            }
        }
        return ($llamadasAgrupadas);
    }

    public function filtrarSede($filters = null)
    {
        // Llama base de datos y devuleve todos los objetos llamada sin filtros pero con relaciones
        if (!$filters) {
            $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo', 'users.sede')
                ->join('users', 'llamadas.interpreterID', '=', 'users.id')
                ->get();
        }

        // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro y relaciones
        else {
            // consulta si hay filtros fecha
            if (!array_key_exists('dates', $filters)) {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'column' => 'lenguaLEP'  (columna bdd) y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo', 'users.sede')
                    ->join('users', 'llamadas.interpreterID', '=', 'users.id')
                    ->where($filters['column'], $filters['value'])->get();
            } else {
                // Llama base de datos y devuleve todos los objetos llamada dependiendo del filtro basado en la columna 'lenguaLEP, fechas siendo columna ' created at y los filtros correspondiente y relaciones
                $llamadas = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'fecha', 'horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo', 'users.sede')
                    ->join('users', 'llamadas.interpreterID', '=', 'users.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            }
        }


        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->categoriaObject = Categoria::where('id', $llamada->tipo)->first();
            $llamada->sedeObject = Sede::where('id', $llamada->sede)->first();
            $llamada->duracion = Carbon::parse($llamada->horaInicio)->diffInMinutes(Carbon::parse($llamada->horaFin));
        }


        $llamadasAgrupadas = [];

        foreach ($llamadas as $llamada) {
            if (array_key_exists($llamada->sede, $llamadasAgrupadas)) {
                // Key already exists, update the values
                $llamadasAgrupadas[$llamada->sede]['llamadasSedeCount'] += 1;
                //Construyes un array u objecto que necesites para agregar a este segundo array
                $llamadasAgrupadas[$llamada->sede]['llamadasArray'][] = $llamada;
            } else {
                // Key doesn't exist, create a new entry
                $llamadasAgrupadas[$llamada->sede] = [
                    'llamadasSedeCount' => 1,
                    'SedeUsado' => $llamada->sede,
                    'llamadasArray' => [$llamada]
                ];
            }
        }
        return ($llamadasAgrupadas);
    }
}
