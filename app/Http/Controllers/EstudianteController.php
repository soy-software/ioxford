<?php

namespace ioxford\Http\Controllers;

use Illuminate\Http\Request;
use ioxford\Models\Estudiante;
use ioxford\Models\Paralelo;
use ioxford\User;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    public function index($paralelo)
    {
        $paralelo=Paralelo::findOrFail($paralelo);
        $periodo=$paralelo->cursoPeriodo->periodo;
        $data = array('paralelo' =>$paralelo ,'periodo'=>$periodo );
        return view('estudiantes.index',$data);
    }

    public function guardar(Request $request)
    {
        $paralelo=Paralelo::findOrFail($request->paralelo);
        $periodo=$paralelo->cursoPeriodo->periodo;

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

    public function enviarMensaje(Request $request)
    {
        return $request;
    }
}
