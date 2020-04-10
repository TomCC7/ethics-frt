<?php
//auto link to model User
//detail info in App\Providers\AuthServiceProvider
namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

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

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    public function destroy(User $currentUser, User $user)
    {
        // admin cannot delete itself
        return ($currentUser->isAdmin() && $currentUser !== $user) || $currentUser === $user;
    }

    public function setAdmin(User $currentUser) {
        return ($currentUser->isSuperadmin());
    }
}
