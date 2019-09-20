<?php

namespace ioxford\Models;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }
}
