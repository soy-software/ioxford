<?php

namespace iouesa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use iouesa\Models\Estudiante;
use iouesa\Models\Paralelo;
use iouesa\User;
use Illuminate\Support\Facades\DB;
use iouesa\Http\Requests\Estudiante\RqActualizar;
use iouesa\Http\Requests\Estudiante\RqGuardar;
use iouesa\Imports\EstudianteImport;
use Maatwebsite\Excel\Facades\Excel;

class EstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function accesso($tipo)
    {
        switch ($tipo) {
            case 'EI':
                $this->authorize('Educación inicial', Periodo::class);
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
            case 'BU':
                $this->authorize('Bachillerato unificado', Periodo::class);
                break;
            default :
            $this->authorize('******', Periodo::class);
            break;
        }
    }
    public function index($paralelo)
    {

        $paralelo=Paralelo::findOrFail($paralelo);
        $this->accesso($paralelo->cursoPeriodo->curso->tipo);
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
                $user->assignRole('ESTUDIANTE');
            }

            $estudiante=Estudiante::where(['user_id'=>$user->id,'paralelo_id'=>$paralelo->id])->first();
            if(!$estudiante){
                $estudiante=new Estudiante();
                $estudiante->user_id=$user->id;
                $estudiante->paralelo_id=$paralelo->id;
                $estudiante->save();
            }

            activity()
        ->causedBy(Auth::user())
        ->performedOn($estudiante)
        ->log('Ingreso nuevo estudiante '.$user->identificacion);


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
        $this->authorize('actualizar', $paralelo->cursoPeriodo->periodo);
        Excel::import(new EstudianteImport($paralelo->id),$request->archivo);
        activity()
        ->causedBy(Auth::user())
        ->performedOn($paralelo)
        ->log('Importo estudiantes al paralelo '.$paralelo->nombre);

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
        $this->authorize('actualizar', $estudiante->paralelo->cursoPeriodo->periodo);
        $user=$estudiante->user;
        $user->name=$request->nombresApellidos;
        $user->identificacion=$request->identificacionEstudiante;
        $user->nombres_representante=$request->nombresApellidosRepresentante;
        $user->identificacion_representante=$request->identificacionRepresentante;
        $user->celular_representante=$request->celularRepresentante;
        $user->email_representante=$request->emailRepresentante;
        $user->save();


        activity()
        ->causedBy(Auth::user())
        ->performedOn($estudiante)
        ->log('Actualizo el estudiante '.$user->identificacion);

        $request->session()->flash('success','Estudiante actualizado exitosamente');
        return redirect()->route('estudiantes',$estudiante->paralelo->id);
    }

    public function retirar(Request $request, $idEst)
    {

        $estudiante=Estudiante::findOrFail($idEst);
        $this->authorize('actualizar', $estudiante->paralelo->cursoPeriodo->periodo);
        try {
            $estudiante->delete();

            activity()
        ->causedBy(Auth::user())
        ->performedOn($estudiante)
        ->log('Eliminino al estudiante '.$estudiante->identificacion);


            $request->session()->flash('success','Estudiante retirado');
        } catch (\Exception $th) {
            $request->session()->flash('default','Estudiante no retirado');
        }
        return redirect()->route('estudiantes',$estudiante->paralelo->id);
    }

}
