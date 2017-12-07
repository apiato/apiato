<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;

/**
 * Class SyncPermissionsOnRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncPermissionsOnRoleAction extends Action
{

    /**
     * @param $roleId
     * @param $singleOrMultiplePermissionIds
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run($roleId, $singleOrMultiplePermissionIds): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$roleId]);

        // convert to array in case single ID was passed
        $permissionsIds = (array)$singleOrMultiplePermissionIds;

        $permissions = array_map(function ($permissionId) {
            return Apiato::call('Authorization@FindPermissionTask', [$permissionId]);
        }, $permissionsIds);

        $role->syncPermissions($permissions);

        return $role;
    }
}
