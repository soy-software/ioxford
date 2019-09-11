<?php

namespace ioxford\Imports;

use ioxford\Models\Estudiante;
use ioxford\Models\Paralelo;
use ioxford\User;
use Maatwebsite\Excel\Concerns\ToModel;

class EstudianteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user=User::where('identificacion',$row[2])->first();
        if(!$user){
            $user=new User();
            $user->name=$row[1];
            $user->identificacion=$row[2];
            $user->nombres_representante=$row[3];
            $user->identificacion_representante=$row[4];
            $user->celular_representante=$row[5];
            $user->email_representante=$row[6];
            $user->save();
        }

        $paralelo=Paralelo::findOrFail($row[0]);

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
