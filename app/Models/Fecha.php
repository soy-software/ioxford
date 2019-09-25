<?php

namespace ioxford\Models;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class)->orderBy('created_at','desc');
    }

    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class, 'paralelo_id');
    }
}
