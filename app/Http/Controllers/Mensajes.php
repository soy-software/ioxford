<?php

namespace ioxford\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ioxford\Http\Requests\Mensajes\RqEnviar;
use ioxford\Models\Estudiante;
use ioxford\Notifications\Mensaje;
use Ixudra\Curl\Facades\Curl;
class Mensajes extends Controller
{
    public function enviar(RqEnviar $request)
    {
        
        $estudiantes=Estudiante::whereIn('id',$request->estudiante)->get();
        
        foreach ($request->tipoMensaje as $tipomsj) {
            foreach ($estudiantes as $estudiante) {
                $nombre=Str::limit($estudiante->user->name,25,'');
                $texto='Sr, Representante el estudiante '.$nombre.'. Ha incurrido una falta en: '.$tipomsj.', por favor acercarse al DECE-OXFORD';
                $data = array('email' =>$estudiante->user->email_representante??'' ,'texto'=>$texto );
                $estudiante->user->notify(new Mensaje($data));
            }    
        }
        
        // $emails_representantes=$estudiantes->pluck('user.email_representante');
        // $celulares_representantes=$estudiantes->pluck('user.celular_representante');
        return 'email enviados';
    }
}
