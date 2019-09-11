<?php

namespace ioxford\Models;

use Illuminate\Database\Eloquent\Model;
use ioxford\User;

class Paralelo extends Model
{
    public function cursoPeriodo()
    {
        return $this->belongsTo(CursoPeriodo::class, 'curso_periodo_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'estudiantes', 'paralelo_id', 'user_id')
        ->as('estudiante')->withPivot(['id']);
    }
}
