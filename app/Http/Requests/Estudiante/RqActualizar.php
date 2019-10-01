<?php

namespace ioxford\Http\Requests\Estudiante;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizar extends FormRequest
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
            'estudiante'=>'required|exists:estudiantes,id',
            'nombresApellidos'=>'required|max:191|regex:'.$letras,
            'identificacionEstudiante'=>'required|max:191|unique:users,identificacion,'.$this->input('estudiante'),
            'nombresApellidosRepresentante'=>'required|max:191|regex:'.$letras,
            'identificacionRepresentante'=>'required',
            'celularRepresentante'=>'required|numeric|digits_between:1,25',
            'emailRepresentante'=>'required|email|string|max:191',

        ];
    }
}
