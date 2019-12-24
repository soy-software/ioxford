<?php

namespace iouesa\Policies;

use iouesa\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function actualizar(User $user, User $model)
    {
        if($user->id==$model->id || $model->hasRole('DECE')){
            return false;
        }else{
            return true;
        }
    }

}
