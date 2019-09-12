<?php

namespace ioxford\Imports;

use ioxford\Models\Estudiante;
use ioxford\Models\Paralelo;
use ioxford\User;
use Maatwebsite\Excel\Concerns\ToModel;

class EstudianteImport implements ToModel
{
   protected $idParalelo;

   public function __construct($idPar)
   {
       $this->idParalelo=$idPar;
   }

    public function model(array $row)
    {
        $user=User::where('identificacion',$row[1])->first();
        if(!$user){
            $user=new User();
            $user->name=$row[0];
            $user->identificacion=$row[1];
            $user->nombres_representante=$row[2];
            $user->identificacion_representante=$row[3];
            $user->celular_representante=$row[4];
            $user->email_representante=$row[5];
            $user->save();
        }

        $paralelo=Paralelo::findOrFail($this->idParalelo);

        $estudiante=Estudiante::where(['user_id'=>$user->id,'paralelo_id'=>$paralelo->id])->first();
        if(!$estudiante){
            $estudiante=new Estudiante();
            $estudiante->user_id=$user->id;
            $estudiante->paralelo_id=$paralelo->id;
            $estudiante->save();
        }

        return $user;

        
    }
}
