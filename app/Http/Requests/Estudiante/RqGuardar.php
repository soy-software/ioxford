<?php

namespace iouesa\Http\Requests\Estudiante;

use Illuminate\Foundation\Http\FormRequest;

class RqGuardar extends FormRequest
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
        $letras='/^[\pL\s\-]+$/u';
        return [
            'nombresApellidos'=>'required|max:191|regex:'.$letras,
            'identificacionEstudiante'=>'required|max:191|unique:users,identificacion',
            'nombresApellidosRepresentante'=>'required|max:191|regex:'.$letras,
            'identificacionRepresentante'=>'required',
            'celularRepresentante'=>'required|numeric|digits_between:1,25',
            'emailRepresentante'=>'required|email|string|max:191',

        ];
    }
}
