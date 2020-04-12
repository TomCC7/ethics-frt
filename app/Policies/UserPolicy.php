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

    public function destroy(User $user)
    {
        /* Superadmin can delete admins
         * Admins can delete users
         * Anyone can delete himself/herself
         * Superadmin cannot delete himself/herself
         */
        $currentUser = Auth::user();
        return (($currentUser->is_admin > $user->is_admin) or $currentUser === $user) and !$user->isSuperadmin();
    }

    public function setAdmin(User $currentUser)
    {
        return $currentUser->isSuperadmin();
    }
}
