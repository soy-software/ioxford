<?php

namespace ioxford\Policies;

use ioxford\User;
use ioxford\Models\Paralelo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParaleloPolicy
{
    use HandlesAuthorization;

 

    public function enviarMensaje(User $user, Paralelo $paralelo)
    {
        switch ($paralelo->cursoPeriodo->curso->tipo) {
            case 'PRE':
                if($user->can('Preparatoría') && $paralelo->cursoPeriodo->periodo->estado=='Proceso'){
                    return true;
                }
                break;
            
            case 'BE':
                
                if($user->can('Básica elemental') && $paralelo->cursoPeriodo->periodo->estado=='Proceso'){
                    return true;
                }
                break;
            case 'BM':
                
                if($user->can('Básica media') && $paralelo->cursoPeriodo->periodo->estado=='Proceso'){
                    return true;
                }
                break;
            case 'BS':
                
                if($user->can('Básica superior') && $paralelo->cursoPeriodo->periodo->estado=='Proceso'){
                    return true;
                }
                break;
            case 'BA':
                if($user->can('Bachillerato') && $paralelo->cursoPeriodo->periodo->estado=='Proceso'){
                    return true;
                }
                break;
            default :
            $this->authorize('******', Periodo::class);   
            break;
        }
    }
}
