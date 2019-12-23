<?php

namespace ioxford\Http\Requests\Mensajes;

use Illuminate\Foundation\Http\FormRequest;

class RqEnviar extends FormRequest
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
            "estudiante"    => "required|array|min:1",
            "estudiante.*"  => "required|exists:estudiantes,id",
            "tipoMensaje"    => "required|array|min:1",
            "tipoMensaje.*"  => "required|in:,Ninguna,Bajo rendimiento,Comportamiento,Asistencia",
            
        ];
    }
}
