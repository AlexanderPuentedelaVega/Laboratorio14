<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecuperarClaveRequest extends FormRequest
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
            "correo" => "required|exists:App\Models\Usuario,correo",
            "clave1" => "required",
            "clave2" => "required"
        ];
    }
    public function messages()
    {
        return [
            "clave1.required" => "Debe llenar este campo",
            "clave2.required" => "Debe llenar este campo"
        ];
    }
}
