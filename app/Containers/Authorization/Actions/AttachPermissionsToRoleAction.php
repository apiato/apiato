<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;

/**
 * Class AttachPermissionsToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleAction extends Action
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
        $permissionIds = (array)$singleOrMultiplePermissionIds;

        $permissions = array_map(function ($permissionId) {
            return Apiato::call('Authorization@FindPermissionTask', [$permissionId]);
        }, $permissionIds);

        $role = $role->givePermissionTo($permissions);

        return $role;
    }
}
