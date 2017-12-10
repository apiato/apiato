<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class SyncPermissionsOnRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncPermissionsOnRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(DataTransporter $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->role_id]);

        // convert to array in case single ID was passed
        $permissionsIds = (array)$data->permissions_ids;

        $permissions = array_map(function ($permissionId) {
            return Apiato::call('Authorization@FindPermissionTask', [$permissionId]);
        }, $permissionsIds);

        $role->syncPermissions($permissions);

        return $role;
    }
}
