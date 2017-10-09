<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AttachPermissionsToRoleTask;
use App\Containers\Authorization\Tasks\FindPermissionTask;
use App\Containers\Authorization\Tasks\FindRoleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class AttachPermissionsToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $role = $this->call(FindRoleTask::class, [$request->role_id]);
        $permissions = [];

        if (is_array($permissionsIds = $request->permissions_ids)) {
            foreach ($permissionsIds as $permissionId) {
                $permissions[] = $this->call(FindPermissionTask::class, [$permissionId]);
            }
        } else {
            $permissions[] = $this->call(FindPermissionTask::class, [$permissionsIds]);
        }

        return $role->givePermissionTo($permissions);
    }
}
