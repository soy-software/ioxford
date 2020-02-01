<?php

namespace iouesa\Http\Requests\Estudiante;

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
            'identificacionEstudiante'=>'required|numeric|digits_between:1,10',
            'nombresApellidosRepresentante'=>'required|max:191|regex:'.$letras,
            'identificacionRepresentante'=>'required|numeric|digits_between:1,10',
            'celularRepresentante'=>'required|numeric|digits_between:1,25',
            'emailRepresentante'=>'required|email|string|max:191',

        ];
    }
}
