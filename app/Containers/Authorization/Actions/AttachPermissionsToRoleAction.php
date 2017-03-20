<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AttachPermissionsToRoleTask;
use App\Containers\Authorization\Tasks\GetPermissionTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
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
     * @param $permissionsIds
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run($roleId, $permissionsIds)
    {
        $role = $this->call(GetRoleTask::class, [$roleId]);
        $permissions = [];

        if (is_array($permissionsIds)) {
            foreach ($permissionsIds as $permissionId) {
                $permissions[] = $this->call(GetPermissionTask::class, [$permissionId]);
            }
        } else {
            $permissions[] = $this->call(GetPermissionTask::class, [$permissionsIds]);
        }

        return $this->call(AttachPermissionsToRoleTask::class, [$role, $permissions]);
    }
}
