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
        // if not in parameters, take from the request object {$this}
        $user = $user ? : $this->user();

        $hasAccess = array_merge(
            $this->hasAnyPermissionAccess($user),
            $this->hasAnyRoleAccess($user)
        );

        // allow access if user has access to any of the defined roles or permissions.
        return empty($hasAccess) ? true : in_array(true, $hasAccess);
    }

    /**
     * @param $user
     *
     * @return  array
     */
    private function hasAnyPermissionAccess($user)
    {
        if (!array_key_exists('permissions', $this->access) || !$this->access['permissions']) {
            return [];
        }

        $permissions = explode('|', $this->access['permissions']);

        $hasAccess = array_map(function ($permission) use ($user) {
            // Note: internal return
            return $user->hasPermissionTo($permission);
        }, $permissions);

        return $hasAccess;
    }

    /**
     * @param $user
     *
     * @return  array
     */
    private function hasAnyRoleAccess($user)
    {
        if (!array_key_exists('roles', $this->access) || !$this->access['roles']) {
            return [];
        }

        $roles = explode('|', $this->access['roles']);

        $hasAccess = array_map(function ($role) use ($user) {
            // Note: internal return
            return $user->hasRole($role);
        }, $roles);

        return $hasAccess;
    }
}
