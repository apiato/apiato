<?php

namespace App\Containers\Authorization\Traits;

use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserAuthorizationTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait UserAuthorizationTrait
{

    /**
     * @return  \App\Containers\User\Models\User|null
     */
    public function getUser()
    {
        return Auth::user();
    }

    /**
     * @param \App\Containers\User\Models\User|null $user
     *
     * @return  boolean
     */
    public function isUserAdmin(User $user = null)
    {
        // if no user provided get the authenticated user.
        if (!$user) {
            $user = $this->getUser();
        }

        return $user->hasRole('admin');
    }
}
