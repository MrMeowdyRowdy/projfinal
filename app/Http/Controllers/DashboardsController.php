<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\EmpresaCliente;
use App\Models\LenguaLEP;
use App\Models\Llamada;
use App\Models\Proveedor;
use App\Models\Rcp;
use App\Models\Sede;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    public function dashboardLenguajes($filters = null)
    {
        $filters['column'] = 'lenguaLEP';
        $filters['value'] = null;
        $idiomas = LenguaLEP::select('id')->get();

        if (!array_key_exists('dates', $filters)) {
            foreach ($idiomas as $idioma) {
                $filters['value'] = $idioma->id;
                $idioma->count = Llamada::select('llamadas.id', 'llamadas.lenguaLEP')
                    ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')
                    ->where($filters['column'], $filters['value'])->count();
                $idioma->lenguaLEP = LenguaLEP::select('lengua')
                    ->where('id', $idioma->id)->first();
                $idioma->lenguaLEP = $idioma->lenguaLEP->lengua;
            }
        } else {
            foreach ($idiomas as $idioma) {
                $filters['value'] = $idioma->id;
                $idioma->count = Llamada::select('llamadas.id', 'llamadas.lenguaLEP')
                    ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->count();
                $idioma->lenguaLEP = LenguaLEP::select('lengua')
                    ->where('id', $idioma->id)->first();
                $idioma->lenguaLEP = $idioma->lenguaLEP->lengua;
            }
        }
        return ($idiomas);
    }

    public function dashboardCategoria($filters = null)
    {
        $filters['column'] = 'tipo';
        $filters['value'] = null;
        $categorias = Categoria::select('id')->get();

        if (!array_key_exists('dates', $filters)) {
            foreach ($categorias as $categoria) {
                $filters['value'] = $categoria->id;
                $categoria->count = Llamada::select('llamadas.id', 'llamadas.tipo')
                    ->join('categorias', 'llamadas.tipo', '=', 'categorias.id')
                    ->where($filters['column'], $filters['value'])->count();
                $categoria->tipo = Categoria::select('categoria')
                    ->where('id', $categoria->id)->first();
                $categoria->tipo = $categoria->tipo->categoria;
            }
        } else {
            foreach ($categorias as $categoria) {
                $filters['value'] = $categoria->id;
                $categoria->count = Llamada::select('llamadas.id', 'llamadas.tipo')
                    ->join('categorias', 'llamadas.tipo', '=', 'categorias.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->count();
                $categoria->tipo = Categoria::select('categoria')
                    ->where('id', $categoria->id)->first();
                $categoria->tipo = $categoria->tipo->categoria;
            }
        }
        return ($categorias);
    }

    public function dashboardCliente($filters = null)
    {
        $filters['column'] = 'empresaCliente';
        $filters['value'] = null;
        $empresaClientes = EmpresaCliente::select('id')->get();

        if (!array_key_exists('dates', $filters)) {
            foreach ($empresaClientes as $empresaCliente) {
                $filters['value'] = $empresaCliente->id;
                $empresaCliente->count = Llamada::select('llamadas.id', 'llamadas.empresaCliente')
                    ->join('empresa_clientes', 'llamadas.empresaCliente', '=', 'empresa_clientes.id')
                    ->where($filters['column'], $filters['value'])->count();
                $empresaCliente->empresaCliente = EmpresaCliente::select('nombre')
                    ->where('id', $empresaCliente->id)->first();
                $empresaCliente->empresaCliente = $empresaCliente->empresaCliente->nombre;
            }
        } else {
            foreach ($empresaClientes as $empresaCliente) {
                $filters['value'] = $empresaCliente->id;
                $empresaCliente->count = Llamada::select('llamadas.id', 'llamadas.empresaCliente')
                    ->join('empresa_clientes', 'llamadas.empresaCliente', '=', 'empresa_clientes.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->count();
                $empresaCliente->empresaCliente = EmpresaCliente::select('nombre')
                    ->where('id', $empresaCliente->id)->first();
                $empresaCliente->empresaCliente = $empresaCliente->empresaCliente->nombre;
            }
        }
        return ($empresaClientes);
    }

    public function dashboardProveedor($filters = null)
    {
        $filters['column'] = 'proveedor';
        $filters['value'] = null;
        $proveedors = Proveedor::select('id')->get();

        if (!array_key_exists('dates', $filters)) {
            foreach ($proveedors as $proveedor) {
                $filters['value'] = $proveedor->id;
                $proveedor->count = Llamada::select('llamadas.id', 'llamadas.proveedor')
                    ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')
                    ->where($filters['column'], $filters['value'])->count();
                $proveedor->proveedor = Proveedor::select('nombre')
                    ->where('id', $proveedor->id)->first();
                $proveedor->proveedor = $proveedor->proveedor->nombre;
            }
        } else {
            foreach ($proveedors as $proveedor) {
                $filters['value'] = $proveedor->id;
                $proveedor->count = Llamada::select('llamadas.id', 'llamadas.proveedor')
                    ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->count();
                $proveedor->proveedor = Proveedor::select('nombre')
                    ->where('id', $proveedor->id)->first();
                $proveedor->proveedor = $proveedor->proveedor->nombre;
            }
        }
        return ($proveedors);
    }

    public function dashboardSede($filters = null)
    {
        $filters['column'] = 'sede';
        $filters['value'] = null;
        $sedes = Sede::select('id')->get();

        if (!array_key_exists('dates', $filters)) {
            foreach ($sedes as $sede) {
                $filters['value'] = $sede->id;

                $sede->count = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'users.sede')
                    ->join('users', 'llamadas.interpreterID', '=', 'users.id')
                    ->where($filters['column'], $filters['value'])->count();
                $sede->sede = Sede::select('sede')
                    ->where('id', $sede->id)->first();
                $sede->sede = $sede->sede->sede;
            }
        } else {
            foreach ($sedes as $sede) {
                $filters['value'] = $sede->id;

                $sede->count = Llamada::select('llamadas.id', 'llamadas.interpreterID', 'users.sede')
                    ->join('users', 'llamadas.interpreterID', '=', 'users.id')
                    ->where($filters['column'], $filters['value'])
                    ->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->count();
                $sede->sede = Sede::select('sede')
                    ->where('id', $sede->id)->first();
                $sede->sede = $sede->sede->sede;
            }
        }
        return ($sedes);
    }

    public function dashboardConProblemas($filters = null)
    {
        $filters['column'] = null;
        $filters['value'] = null;
        $llamadas = null;
        if (!array_key_exists('dates', $filters)) {
            $llamadas = Llamada::select('fecha')->distinct()->whereDate('fecha', '>=', now()->subDays(7)->toDateString())->get();
            foreach ($llamadas as $llamada) {
                $llamada->count = Llamada::select('id')
                    ->where('fecha', $llamada->fecha)
                    ->count();
                $llamada->rcpCount = Rcp::select('id')
                    ->where('rcps.fecha', $llamada->fecha)
                    ->count();
                $llamada->count = $llamada->count - $llamada->rcpCount;
            }
        } else {
            $llamadas = Llamada::select('fecha')->distinct()->whereBetween('llamadas.fecha', [$filters['dates']['startdate'], $filters['dates']['enddate']])->get();
            foreach ($llamadas as $llamada) {
                $llamada->count = Llamada::select('id')
                    ->where('fecha', $llamada->fecha)
                    ->count();
                $llamada->rcpCount = Rcp::select('id')
                    ->where('rcps.fecha', $llamada->fecha)
                    ->count();
                $llamada->count = $llamada->count - $llamada->rcpCount;
            }
        }
        return ($llamadas);
    }
}
