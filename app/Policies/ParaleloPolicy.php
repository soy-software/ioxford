<?php

namespace iouesa\Policies;

use iouesa\User;
use iouesa\Models\Paralelo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParaleloPolicy
{
    use HandlesAuthorization;

 

    public function enviarMensaje(User $user, Paralelo $paralelo)
    {
        switch ($paralelo->cursoPeriodo->curso->tipo) {
            case 'EI':
                if($user->can('Educación inicial') && $paralelo->cursoPeriodo->periodo->estado=='Proceso'){
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
            case 'BU':
                if($user->can('Bachillerato unificado') && $paralelo->cursoPeriodo->periodo->estado=='Proceso'){
                    return true;
                }
                break;
        }
    }
}
