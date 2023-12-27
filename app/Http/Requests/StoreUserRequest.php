<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nroDocIdentificacion' => 'required',
            'sede' => 'required',
            'apellido' => 'required',
            'name' => 'required',
            'tlfContacto' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'emailRackspace' => 'required|email:rfc,dns|unique:users,email',
            'fullTime' => 'required',
            'categoria' => 'required',
            'horario' => 'required',
            'username' => 'required|unique:users,username',
        ];
    }
}