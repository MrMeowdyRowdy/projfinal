<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLlamadaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'interpreterID' => 'required|starts_with:3|integer',
            'horaInicio' => 'required',
            'horaFin' => 'required',
            'empresaCliente' => 'required',
            'proveedor' => 'required',
            'lenguaLEP' => 'required',
            'tipo' => 'required',
            'especializacion' => 'required'
        ];
    }
}
