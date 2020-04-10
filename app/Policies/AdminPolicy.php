<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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

    public function admin(User $currentUser)
    {
        return $currentUser->is_admin==true;
    }

    public function superadmin(User $currentUser)
    {
        return $currentUser->is_admin===2;
    }
}
