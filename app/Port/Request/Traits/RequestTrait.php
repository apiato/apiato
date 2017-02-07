<?php

namespace App\Port\Request\Traits;

/**
 * Class RequestTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait RequestTrait
{

    /**
     * This function will be called from the Requests (authorize) to check if a user
     * has permission to perform an action.
     * User can set multiple permissions (separated with "|") and if the user has
     * any of the permissions, he will be authorize to proceed with this action.
     *
     * @return  bool
     */
    public function validatePermission()
    {
        // $this->access is optionally set on the Request

        // allow access when the access is not defined
        // allow access when nothing no roles or permissions are declared
        if (!isset($this->access) || !isset($this->access['permission'])) {
            return true;
        }

        // allow access if has permission set but is empty or null
        if(!$this->access['permission']){
            return true;
        }

        $permissions = explode('|', $this->access['permission']);

        $hasPermission = array_map(function($permission) {
            return $this->user()->hasPermissionTo($permission);
        }, $permissions);

        // allow access if user has access to any of the defined permissions.
        return in_array(true, $hasPermission);
    }

}
