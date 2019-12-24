<?php

namespace iouesa\Models;

use Illuminate\Database\Eloquent\Model;

class CursoPeriodo extends Model
{
    public function paralelos()
    {
        return $this->hasMany(Paralelo::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }
}
