<?php

namespace ioxford\Http\Controllers;

use Illuminate\Http\Request;
use ioxford\Models\Periodo;

class CursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($tipo,$periodo)
    {
        switch ($tipo) {
            case 'PRE':
                $this->authorize('Preparatoría', Periodo::class);   
                break;
            
            case 'BE':
                $this->authorize('Básica elemental', Periodo::class);   
                break;
            case 'BM':
                $this->authorize('Básica media', Periodo::class);   
                break;
            case 'BS':
                $this->authorize('Básica superior', Periodo::class);   
                break;
            case 'BA':
                $this->authorize('Bachillerato', Periodo::class);   
                break;
            default :
            $this->authorize('******', Periodo::class);   
            break;
        }

        $periodo=Periodo::findOrFail($periodo);
        $cursos=$periodo->cursos->where('tipo',$tipo);    
        $data = array('periodo' => $periodo,'cursos'=>$cursos,'tipo'=>$tipo );
         return view('cursos.index',$data);
    }
    
}
