<?php

namespace ioxford\Policies;

use ioxford\User;
use ioxford\Models\Periodo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeriodoPolicy
{
    use HandlesAuthorization;
    
    public function crear(User $user)
    {
        $per=Periodo::where('estado','Proceso')->first();
        if (!$per && $user->can('Períodos')) {
            return true;
        }
    }

    public function actualizar(User $user, Periodo $periodo)
    {
        if($periodo->estado=='Proceso' && $user->can('Períodos')){
            return true;
        }
    }

}
