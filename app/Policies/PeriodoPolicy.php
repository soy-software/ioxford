<?php

namespace iouesa\Policies;

use iouesa\User;
use iouesa\Models\Periodo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeriodoPolicy
{
    use HandlesAuthorization;
    
    public function crear(User $user)
    {
        $per=Periodo::where('estado','Proceso')->first();
        if ($user->can('Períodos')) {
            return true;
        }
    }

    public function actualizar(User $user, Periodo $periodo)
    {
        if($periodo->estado=='Proceso'){
            if($user->can('Períodos')){
                return true;
            }
        }
    }

    public function enviarMensaje(User $user, Periodo $periodo)
    {

        $opciones = array(
            'Preparatoría',
            'Básica elemental',
            'Básica media',
            'Básica superior',
            'Bachillerato ',
        );

        foreach ($opciones as $op) {
            if($user->can($op) && $periodo->estado=='Proceso'){
                return true;
            }
        }
    }
}
