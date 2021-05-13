<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class AreasRolUpdateRequest extends FormRequest
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
            'id_area' => 'required|unique_with:areas_rol,name,id_area,'.Input::get('id'),
        ];
    }

    public function messages() {
        return [
            "name.required" => "El nombre del rol es requerido",
            "name.min" => "El nombre del rol debe contener mínimo 2 caracteres",
            "name.max" => "El nombre del rol debe contener máximo 25 caracteres",
            "name.regex" => "El nombre del rol debe contener solo letras",
            "name.unique" => "El nombre del rol ya existe",
            "id_area.unique_with" => "El nombre del rol ya existe con está área",
            "id_area.required" => "El area es requerida",
        ];
    }
}
