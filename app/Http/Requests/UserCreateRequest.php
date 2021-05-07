<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'dni' => 'required|digits_between:8,8|numeric|unique:users,dni',
        ];
    }

    public function messages() {
        return [
            "dni.required" => "El DNI es requerido",
            "dni.digits_between" => "El DNI debe contener 8 caracteres",
            "dni.unique" => "El DNI ya existe",
        ];
    }
}
