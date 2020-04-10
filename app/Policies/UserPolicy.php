<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $authUser, $ability)
    {
        if($authUser->rol === \App\Patrones\Rol::Administrador)
        {
            return true;
        }
    }

    public function show(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }
}
