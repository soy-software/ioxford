<?php

namespace ioxford\Models;

use Illuminate\Database\Eloquent\Model;
use ioxford\User;

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

}
