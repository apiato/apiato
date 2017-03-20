<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\GetPermissionTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\Authorization\Tasks\SyncPermissionsOnRoleTask;
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
     * @param $permissionsIds
     *
     * @return  mixed
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

        return $this->call(SyncPermissionsOnRoleTask::class, [$role, $permissions]);
    }
}
