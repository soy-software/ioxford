<?php

namespace iouesa\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $guarded = [];  
    
    
    // para sync
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_periodos', 'periodo_id', 'curso_id')
        ->as('curso_periodos')
        ->withPivot(['id']);;
    }
}
