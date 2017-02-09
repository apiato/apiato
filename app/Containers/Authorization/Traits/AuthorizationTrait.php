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

    /**
     * @return  mixed
     */
    public function hasClientRole()
    {
        return $this->hasRole('client');
    }


    /**
     * This function will be called from the Requests (authorize) to check if a user
     * has permission to perform an action.
     * User can set multiple permissions (separated with "|") and if the user has
     * any of the permissions, he will be authorize to proceed with this action.
     *
     * @return  bool
     */
    public function hasAccess(User $user = null)
    {
        if(!$user){
            $user = $this->user();
        }

        // $this->access is optionally set on the Request

        // allow access when the access is not defined
        // allow access when nothing no roles or permissions are declared
        if (!isset($this->access) || !isset($this->access['permission'])) {
            return true;
        }

        // allow access if has permission set but is empty or null
        if (!$this->access['permission']) {
            return true;
        }

        $permissions = explode('|', $this->access['permission']);

        $hasAccess = array_map(function ($permission) use ($user){
            return $user->hasPermissionTo($permission);
        }, $permissions);

        // allow access if user has access to any of the defined permissions.
        return in_array(true, $hasAccess);
    }
}
