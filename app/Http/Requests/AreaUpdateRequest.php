<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class AreaUpdateRequest extends FormRequest
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
            'name' => 'required|min:2|max:25|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|unique:areas,name,'.Input::get('id'),
            'acronym' => 'required|min:2|max:25|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|unique:areas,acronym,'.Input::get('id'),
        ];
    }

    public function messages() {
        return [
            "name.unique" => "La encuesta ya existe",
            "name.required" => "El nombre del área es requerido",
            "name.min" => "El nombre del área debe contener mínimo 2 caracteres",
            "name.max" => "El nombre del área debe contener máximo 25 caracteres",
            "name.regex" => "El nombre del área debe contener solo letras",
            "name.unique" => "El nombre del área ya existe",
            "acronym.required" => "El acrónimo del área es requerido",
            "acronym.min" => "El acrónimo del área debe contener mínimo 2 caracteres",
            "acronym.max" => "El acrónimo del área debe contener máximo 25 caracteres",
            "acronym.regex" => "El acrónimo del área debe contener solo letras",
            "acronym.unique" => "El acrónimo ya existe",
        ];
    }
}
