<?php

namespace ioxford\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }
}
