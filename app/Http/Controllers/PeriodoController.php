<?php

namespace iouesa\Http\Controllers;

use iouesa\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use iouesa\Models\Curso;

class PeriodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $periodos=Periodo::orderBy('created_at','desc')->paginate(10);
        return view('periodos.index',compact('periodos'));
    }

    public function guardar(Request $request)
    {
        $this->authorize('crear', Periodo::class);

        $request->validate([
            'nombre' => 'required|max:191',
            'fecha_inicio' => 'required|date|date_format:Y-m-d',
            'fecha_final' => 'required|date|date_format:Y-m-d|after:fecha_inicio',
        ]);

       $periodo= Periodo::create(
            [
                'nombre'=>$request->nombre,
                'fecha_inicio'=>$request->fecha_inicio,
                'fecha_final'=>$request->fecha_final,
            ]
        );
        
        $cursos=Curso::all();
        $periodo->cursos()->sync($cursos->pluck('id'));
        
        activity()
        ->causedBy(Auth::user())
        ->performedOn($periodo)
        ->log('Creo nuevo período '.$periodo->nombre??'');

        return redirect()->route('periodos')->with('success','Período ingresado exitosamente');

    }

    public function estado(Request $request)
    {
        $request->validate([
            'periodo' => 'required|exists:periodos,id',
        ]);
        $per=Periodo::findOrFail($request->periodo);
        if($per->estado=="Proceso"){
            $per->estado='Finalizado';
        }else{
            $per->estado='Proceso';
        }
        $per->save();
        
        activity()
        ->causedBy(Auth::user())
        ->performedOn($per)
        ->log('Cambio el estado de periodo '.$per->nombre??' a'.$per->estado);


        return response()->json(['ok'=>'Actualizado exitosamente']);
    }
    public function editar($idPer)
    {
        $periodo=Periodo::findOrFail($idPer);
        return view('periodos.editar',['per'=>$periodo]);
    }

    public function actualizar(Request $request)
    {
        

        $request->validate([
            'periodo'=>'required|exists:periodos,id',
            'nombre' => 'required|max:191|unique:periodos,nombre,'.$request->periodo,
            'fecha_inicio' => 'required|date|date_format:Y-m-d',
            'fecha_final' => 'required|date|date_format:Y-m-d|after:fecha_inicio',
        ]);
        $periodo=Periodo::findOrFail($request->periodo);
        $this->authorize('actualizar', $periodo);
        $periodo->nombre=$request->nombre;
        $periodo->fecha_inicio=$request->fecha_inicio;
        $periodo->fecha_final=$request->fecha_final;
        $periodo->save();


        activity()
        ->causedBy(Auth::user())
        ->performedOn($periodo)
        ->log('Actualizo el periodo '.$periodo->nombre??'');

        return redirect()->route('periodos')->with('success','Período actualizado exitosamente');
    }
}
