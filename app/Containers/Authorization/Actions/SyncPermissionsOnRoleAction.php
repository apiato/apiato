<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class SyncPermissionsOnRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncPermissionsOnRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $role = $this->call('Authorization@GetRoleTask', [$request->role_id]);
        $permissions = [];

        if (is_array($permissionsIds = $request->permissions_ids)) {
            foreach ($permissionsIds as $permissionId) {
                $permissions[] = $this->call('Authorization@GetPermissionTask', [$permissionId]);
            }
        } else {
            $permissions[] = $this->call('Authorization@GetPermissionTask', [$permissionsIds]);
        }

        $role->syncPermissions($permissions);

        return $role;
    }
}
