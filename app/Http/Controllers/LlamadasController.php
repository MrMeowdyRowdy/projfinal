<?php

namespace App\Http\Controllers;


use App\Models\Categoria;
use App\Models\LenguaLEP;
use App\Models\Proveedor;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLlamadaRequest;
use App\Http\Requests\UpdateLlamadaRequest;
use App\Models\Llamada;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\EmpresaCliente;


class LlamadasController extends Controller
{
    /**
     * Display all llamadas
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters['column'] = 'interpreterID';
        $filters['value'] = auth()->id();
        if((Auth::user()->hasRole('TeamLeader')))
        {
            $llamadas = Llamada::latest()->paginate(10);
        }
        else{
            
            $llamadas = Llamada::select('*')
                    ->where($filters['column'], $filters['value'])->get();
        }
        foreach ($llamadas as $llamada) {
            $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
            $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
            $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
            $llamada->categoriaObject = Categoria::where('id', $llamada->tipo)->first();
        }
        return view('llamadas.index', compact('llamadas'));
    }

    /**
     * Show form for creating llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('llamadas.create', [
            'empresa_clientes' => EmpresaCliente::latest()->get(),
            'proveedors' => Proveedor::latest()->get(),
            'lenguaLEPs' => LenguaLEP::latest()->get(),
            'tipos' => Categoria::latest()->get()
        ]);
    }

    /**
     * Store a newly created llamada
     * 
     * @param Llamada $llamada
     * @param StoreLlamadaRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Llamada $llamada, StoreLlamadaRequest $request)
    {
        Llamada::create(array_merge($request->only('horaInicio', 'horaFin', 'empresaCliente', 'proveedor', 'lenguaLEP', 'tipo'), [
            'interpreterID' => auth()->id()
        ]));

        return redirect()->route('llamadas.index')
            ->withSuccess(__('Llamada registrada correctamente.'));
    }

    /**
     * Show llamada data
     * 
     * @param Llamada $llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Llamada $llamada)
    {

        $llamada->empresaClienteObject = EmpresaCliente::where('id', $llamada->empresaCliente)->first();
        $llamada->proveedorObject = Proveedor::where('id', $llamada->proveedor)->first();
        $llamada->lenguaLEPObject = LenguaLEP::where('id', $llamada->lenguaLEP)->first();
        $llamada->categoriaObject = Categoria::where('id', $llamada->tipo)->first();
        return view('llamadas.show', [
            'llamada' => $llamada
        ]);
    }

    /**
     * Edit llamada data
     * 
     * @param Llamada $llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Llamada $llamada)
    {

        return view('llamadas.edit', [
            'llamada' => $llamada,
            'empresa_clientes' => EmpresaCliente::latest()->get(),
            'proveedors' => Proveedor::latest()->get(),
            'lenguaLEPs' => LenguaLEP::latest()->get(),
            'tipos' => Categoria::latest()->get()
        ]);
    }
    /**
     * Update llamada data
     * 
     * @param Llamada $llamada
     * @param UpdateLlamadaRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Llamada $llamada, UpdateLlamadaRequest $request)
    {
        $llamada->update($request->validated());

        return redirect()->route('llamadas.index')
            ->withSuccess(__('Llamada actualizada correctamente.'));
    }

    /**
     * Delete llamada data
     * 
     * @param Llamada $llamada
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Llamada $llamada)
    {
        $llamada->delete();

        return redirect()->route('llamadas.index')
            ->withSuccess(__('Llamada eliminada correctamente.'));
    }

    
}
