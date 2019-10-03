<?php

namespace ioxford\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ioxford\Http\Requests\Mensajes\RqEnviar;
use ioxford\Models\Estudiante;
use ioxford\Models\Fecha;
use ioxford\Models\Paralelo;
use ioxford\Notifications\MensajeNotifi;
use ioxford\Models\Mensaje;
use PDF;
class Mensajes extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enviar(RqEnviar $request)
    {
        $paralelo=Paralelo::findOrFail($request->paralelo);
        $this->authorize('enviarMensaje', $paralelo);
        try {
            DB::beginTransaction();
            $estudiantes=Estudiante::whereIn('id',$request->estudiante)->get();
            
            $fecha=Fecha::where(['paralelo_id'=>$paralelo->id,'fecha'=>Carbon::now()->toDateString()])->first();
            if(!$fecha){
                $fecha=new Fecha;
                $fecha->paralelo_id=$paralelo->id;
                $fecha->fecha=Carbon::now();
                $fecha->save();
            }

            foreach ($request->tipoMensaje as $tipomsj) {
                foreach ($estudiantes as $estudiante) {
                    
                    $nombre=Str::limit($estudiante->user->name,25,'');
                    $texto='Sr, Representante el estudiante '.$nombre.'. Ha incurrido una falta en: '.$tipomsj.', por favor acercarse al DECE-OXFORD';
                    $data = array('email' =>$estudiante->user->email_representante??'' ,'texto'=>$texto );
                    $estudiante->user->notify(new MensajeNotifi($data));
                    $mensaje=new Mensaje();
                    $mensaje->fecha_id=$fecha->id;
                    $mensaje->estudiante_id=$estudiante->id;
                    $mensaje->tipo=$tipomsj;
                    $mensaje->estado=true;
                    $mensaje->save();
                }    
            }

            DB::commit();
            return response()->json(['success'=>'Mensaje enviado exitosamente']);
        } catch (\Exception $th) {
            DB::rollback();
            return response()->json(['info'=>'Ocurrio un error, vuelva intentar '.$th->getMessage()]);
        }

    }


    public function reportes($idParalelo)
    {
        $paralelo=Paralelo::findOrFail($idParalelo);
        $data = array('paralelo' => $paralelo,'fechas'=>$paralelo->fechas()->paginate(10));
        return view('mensajes.reportes',$data);
    }

    public function lista($idFecha)
    {
        $fecha=Fecha::findOrFail($idFecha);
        $data = array('fecha' => $fecha);
        return view('mensajes.lista',$data);
    }

    public function mensajeXestudiante($idEstudiante)
    {
        $estudiante=Estudiante::findOrFail($idEstudiante);
        return view('mensajes.porEstudiantes',['estudiante'=>$estudiante]);
    }

    public function estado(Request $request)
    {
        
        $request->validate([
            'mensaje' => 'required|exists:mensajes,id',
        ]);
        $per=Mensaje::findOrFail($request->mensaje);

        $this->authorize('actualizar', $per->estudiante->paralelo->cursoPeriodo->periodo);

        if($per->estado==true){
            $per->estado=false;
        }else{
            $per->estado=true;
        }
        $per->save();
        return response()->json(['ok'=>'Actualizado exitosamente']);
    }

    public function imprimirCartaCompromiso($idEstudiante)
    {
        $estudiante=Estudiante::findOrFail($idEstudiante);
        $mensajes=$estudiante->mensajesImprimir;
        $pdf = PDF::loadView('mensajes.imprimirCartaCompromiso', ['mensajes'=>$mensajes,'estudiante'=>$estudiante]);
        return $pdf->inline('carta_compromiso.pdf');
    }

    public function pdfListaMensajes($idFecha)
    {
        $fecha=Fecha::findOrFail($idFecha);
        $pdf = PDF::loadView('mensajes.pdfListaMensajes', ['fecha'=>$fecha]);
        return $pdf->inline('lista_de_mensajes.pdf');
    }
 
}
