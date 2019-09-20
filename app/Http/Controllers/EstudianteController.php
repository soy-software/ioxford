<?php

namespace ioxford\Http\Controllers;

use Illuminate\Http\Request;
use ioxford\Models\Estudiante;
use ioxford\Models\Paralelo;
use ioxford\User;
use Illuminate\Support\Facades\DB;
use ioxford\Http\Requests\Estudiante\RqActualizar;
use ioxford\Http\Requests\Estudiante\RqGuardar;
use ioxford\Imports\EstudianteImport;
use Maatwebsite\Excel\Facades\Excel;

class EstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($paralelo)
    {
        $paralelo=Paralelo::findOrFail($paralelo);
        $periodo=$paralelo->cursoPeriodo->periodo;
        $data = array('paralelo' =>$paralelo ,'periodo'=>$periodo );
        return view('estudiantes.index',$data);
    }

    public function nuevo($idParalelo)
    {
        $paralelo=Paralelo::findOrFail($idParalelo);
        $periodo=$paralelo->cursoPeriodo->periodo;
        return view('estudiantes.nuevo',['paralelo'=>$paralelo,'periodo'=>$periodo]);
    }
    public function guardar(RqGuardar $request)
    {
        $paralelo=Paralelo::findOrFail($request->paralelo);
        $periodo=$paralelo->cursoPeriodo->periodo;
        $this->authorize('actualizar', $periodo);

       try {
            DB::beginTransaction();
            $user=User::where('identificacion',$request->identificacionEstudiante)->first();
            if(!$user){
                $user=new User();
                $user->name=$request->nombresApellidos;
                $user->identificacion=$request->identificacionEstudiante;
                $user->nombres_representante=$request->nombresApellidosRepresentante;
                $user->identificacion_representante=$request->identificacionRepresentante;
                $user->celular_representante=$request->celularRepresentante;
                $user->email_representante=$request->emailRepresentante;
                $user->save();
            }
            
            $estudiante=Estudiante::where(['user_id'=>$user->id,'paralelo_id'=>$paralelo->id])->first();
            if(!$estudiante){
                $estudiante=new Estudiante();
                $estudiante->user_id=$user->id;
                $estudiante->paralelo_id=$paralelo->id;
                $estudiante->save();
            }

            DB::commit();
            $request->session()->flash('success','Estudiante ingresado exitosamente');
       } catch (\Exception $th) {
           DB::rollBack();
           $request->session()->flash('info','Estudiante no ingresado, vuelva intentar');
       }

        return redirect()->route('estudiantes',$request->paralelo);
        
    }

    public function importar($idParalelo)
    {
        $paralelo=Paralelo::findOrFail($idParalelo);
        $periodo=$paralelo->cursoPeriodo->periodo;
        return view('estudiantes.importar',['paralelo'=>$paralelo,'periodo'=>$periodo]);
    }
    public function importarEstudiante(Request $request)
    {
        $paralelo=Paralelo::findOrFail($request->paralelo);
        Excel::import(new EstudianteImport($paralelo->id),$request->archivo);
        $request->session()->flash('success','Estudiante importados exitosamente');
        return redirect()->route('estudiantes',$request->paralelo);
    }

    public function editar($idEst)
    {
        $estudiante=Estudiante::findOrFail($idEst);
        return view('estudiantes.editar',['est'=>$estudiante]);
    }
    
    public function actualizar(RqActualizar $request)
    {
        $estudiante=Estudiante::findOrFail($request->estudiante);
        $user=$estudiante->user;
        $user->name=$request->nombresApellidos;
        $user->identificacion=$request->identificacionEstudiante;
        $user->nombres_representante=$request->nombresApellidosRepresentante;
        $user->identificacion_representante=$request->identificacionRepresentante;
        $user->celular_representante=$request->celularRepresentante;
        $user->email_representante=$request->emailRepresentante;
        $user->save();
        
        
        $request->session()->flash('success','Estudiante actualizado exitosamente');
        return redirect()->route('estudiantes',$estudiante->paralelo->id);
    }

    public function retirar(Request $request, $idEst)
    {
        
        $estudiante=Estudiante::findOrFail($idEst);
        try {
            $estudiante->delete();
            $request->session()->flash('success','Estudiante retirado');    
        } catch (\Exception $th) {
            $request->session()->flash('default','Estudiante no retirado');    
        }
        return redirect()->route('estudiantes',$estudiante->paralelo->id);
    }
    
    

    public function enviarMensaje(Request $request)
    {
       return 'ok';
    }
}
