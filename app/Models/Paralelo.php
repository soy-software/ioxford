<?php

namespace ioxford\Models;

use Illuminate\Database\Eloquent\Model;

class Paralelo extends Model
{
    public function cursoPeriodo()
    {
        return $this->belongsTo(CursoPeriodo::class, 'curso_periodo_id');
    }
}
