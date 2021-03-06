<?php

namespace iouesa\Models;

use Illuminate\Database\Eloquent\Model;
use iouesa\User;

class Mensaje extends Model
{
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    // d:SABER  QUE USUARIO ENVIO EL MENSAJE
    public function enviadoX()
    {
        return $this->belongsTo(User::class,'enviadoPor');
    }
}
