<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Sale;
use App\Patrones\Rol;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
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
        if($authUser->rol === Rol::Administrador)
        {
            return true;
        }
    }

    public function destroy(User $userAuth, Sale $sale)
    {
        return $userAuth->id === $sale->users_id;
    }
}
