<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePropietarioRequest extends FormRequest
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
            'telefono' => 'required|numeric',
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'telefono.required' => 'Debes ingresar un número de teléfono de contacto.',
            'telefono.numeric' => 'El número de telefono debe contener solo números',

            'email.required'  => 'Debes ingresr un correo electronico para inicio de sesión',
            'email.email'  => 'El correo electronico no tiene un formato valido.',
        ];
    }
}
