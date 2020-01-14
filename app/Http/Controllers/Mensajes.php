<?php

namespace iouesa\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use iouesa\Http\Requests\Mensajes\RqEnviar;
use iouesa\Models\Estudiante;
use iouesa\Models\Fecha;
use iouesa\Models\Paralelo;
use iouesa\Notifications\MensajeNotifi;
use iouesa\Models\Mensaje;
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
                    
                    
                    if($tipomsj=='Ninguna'){
                        $texto=$request->extra;
                    }else{
                        $texto='Sr, Representante el estudiante '.$nombre.'. Ha incurrido una falta en: '.$tipomsj.', acercarse al DECE SAN FRANCISCO DE ASIS';
                    }
                    
                    $data = array('email' =>$estudiante->user->email_representante??'' ,'extra'=>$request->extra,'texto'=>$texto,'tipo'=>$tipomsj );
                    $estudiante->user->notify(new MensajeNotifi($data));

                    $data_api = [
                        'phone' => $estudiante->user->celular_representante,
                        'body' => $texto,
                    ];
                    $json_api = json_encode($data_api);
                    $url_api = 'https://eu53.chat-api.com/instance91893/sendMessage?token=2b4vhj77ohhdevuh';
                    $options = stream_context_create(['http' => [
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json_api
                        ]
                    ]);
                   file_get_contents($url_api, false, $options);



                    $mensaje=new Mensaje();
                    $mensaje->fecha_id=$fecha->id;
                    $mensaje->estudiante_id=$estudiante->id;
                    if($tipomsj!='Ninguna'){
                        $mensaje->tipo=$tipomsj;
                    }
                    $mensaje->estado=true;
                    $mensaje->enviadoPor=Auth::id();
                    $mensaje->save();
                }    
            }
            

            activity()
            ->causedBy(Auth::user())
            ->performedOn($paralelo)
            ->log('Envio mensaje en paralelo ',$paralelo->nombre);

            DB::commit();
            return response()->json(['success'=>'Mensaje enviado exitosamente']);
        } catch (\Exception $th) {
            DB::rollback();
            return response()->json(['info'=>'Ocurrio un error, vuelva intentar ']);
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

        activity()
        ->causedBy(Auth::user())
        ->performedOn($per)
        ->log('Cambio de estado de mensaje a '.$per->estado);

        return response()->json(['ok'=>'Actualizado exitosamente']);
    }

    public function imprimirCartaCompromiso($idEstudiante)
    {
        $estudiante=Estudiante::findOrFail($idEstudiante);
        $mensajes=$estudiante->mensajesImprimir;
        $pdf = PDF::loadView('mensajes.imprimirCartaCompromiso', ['mensajes'=>$mensajes,'estudiante'=>$estudiante]);

        activity()
        ->causedBy(Auth::user())
        ->performedOn($estudiante)
        ->log('Imprimio carta de presentación de '.$estudiante->user->identificacion??'');

        return $pdf->inline('carta_compromiso.pdf');
    }

    public function pdfListaMensajes($idFecha)
    {
        $fecha=Fecha::findOrFail($idFecha);
        $pdf = PDF::loadView('mensajes.pdfListaMensajes', ['fecha'=>$fecha]);
        return $pdf->inline('lista_de_mensajes.pdf');
    }
 
}
