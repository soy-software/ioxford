<?php

namespace iouesa\Models;

use Illuminate\Database\Eloquent\Model;
use iouesa\User;

class Estudiante extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class, 'paralelo_id');
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    public function mensajesImprimir()
    {
        return $this->hasMany(Mensaje::class)->where('estado',true);
    }

}
