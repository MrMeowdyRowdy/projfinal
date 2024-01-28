<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Llamada;

use Illuminate\Support\Carbon;

class UsersApiController extends Controller
{
    public function index()
    {
        $llamadas = Llamada::select('llamadas.id','llamadas.interpreterID','llamadas.horaInicio','llamadas.horaFin','empresa_clientes.nombre','proveedors.nombre','lengua_l_e_p_s.lengua','categorias.categoria')
        ->join('empresa_clientes', 'llamadas.empresaCliente', '=', 'empresa_clientes.id')
        ->join('proveedors', 'llamadas.proveedor', '=', 'proveedors.id')
        ->join('lengua_l_e_p_s', 'llamadas.lenguaLEP', '=', 'lengua_l_e_p_s.id')
        ->join('categorias', 'llamadas.tipo', '=', 'categorias.id')
        ->get();
        foreach ($llamadas as $llamada) {
            $llamada->duracion = Carbon::parse($llamada->horaInicio)->diffInMinutes(Carbon::parse($llamada->horaFin));
        }
        return $llamadas;
    }
}
