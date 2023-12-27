<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLlamadaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'horaInicio' => 'required',
            'horaFin' => 'required',
            'empresaCliente' => 'required',
            'proveedor' => 'required',
            'lenguaLEP' => 'required',
            'tipo' => 'required'
        ];
    }
}
