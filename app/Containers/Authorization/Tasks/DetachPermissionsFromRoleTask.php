<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task;

/**
 * Class DetachPermissionsFromRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleTask extends Task
{

    /**
     * @param \App\Containers\Authorization\Models\Role $role
     * @param                                           $permissionsIds
     *
     * @return  \App\Containers\Authorization\Models\Role|\Spatie\Permission\Traits\HasPermissions
     */
    public function run(Role $role, $permissionsIds)
    {

        if (is_array($permissionsIds)) {
            foreach ($permissionsIds as $permissionId) {
                $role = $role->revokePermissionTo($permissionId);
            }
        } else {
            $role = $role->revokePermissionTo($permissionsIds);
        }

        return $role;
    }
}
