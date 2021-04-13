<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task;

class DetachPermissionsFromRoleTask extends Task
{
    public function run(Role $role, $singleOrMultiplePermissionIds): Role
    {
        if (!is_array($singleOrMultiplePermissionIds)) {
            $singleOrMultiplePermissionIds = [$singleOrMultiplePermissionIds];
        }

        // remove each permission ID found in the array from that role.
        array_map(static function ($permissionId) use ($role) {
            $permission = app(FindPermissionTask::class)->run($permissionId);
            $role->revokePermissionTo($permission);
        }, $singleOrMultiplePermissionIds);

        return $role;
    }
}
