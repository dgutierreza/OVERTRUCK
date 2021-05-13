<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreasRolCreateRequest extends FormRequest
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
            'name' => 'required|min:2|max:25|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'area' => 'required|unique_with:areas_rol,name,area = id_area',
        ];
    }

    public function messages() {
        return [
            "name.required" => "El nombre del rol es requerido",
            "name.min" => "El nombre del rol debe contener mínimo 2 caracteres",
            "name.max" => "El nombre del rol debe contener máximo 25 caracteres",
            "name.regex" => "El nombre del rol debe contener solo letras",
            "name.unique" => "El nombre del rol ya existe",
            "area.unique_with" => "El nombre del rol ya existe con está área",
            "area.required" => "El area es requerida",
        ];
    }
}
