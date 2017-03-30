<?php

namespace App\Containers\Authorization\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Class AuthorizationTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait AuthorizationTrait
{
    /**
     * @return  \App\Containers\User\Models\User|null
     */
    public function getUser()
    {
        return Auth::user();
    }

    /**
     * @return  mixed
     */
    public function hasAdminRole()
    {
        return $this->hasRole('admin');
    }

}
