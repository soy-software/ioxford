<?php

namespace iouesa\Models;

use Illuminate\Database\Eloquent\Model;
use iouesa\User;

class Paralelo extends Model
{
    public function cursoPeriodo()
    {
        return $this->belongsTo(CursoPeriodo::class, 'curso_periodo_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'estudiantes', 'paralelo_id', 'user_id')
        ->as('estudiante')->withPivot(['id'])
        ->orderBy('name');
    }

    public function fechas()
    {
        return $this->hasMany(Fecha::class);
    }

}
