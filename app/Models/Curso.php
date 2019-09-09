<?php

namespace ioxford\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nombre', 'tipo'
    ];

    public function paralelos($curso_periodo_id)
    {
        $c_p=CursoPeriodo::find($curso_periodo_id);
        if($c_p){
            return  $c_p;
        }else{
            return '';
        }
    }
}
