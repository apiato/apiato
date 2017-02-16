<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Actions\GetRoleAction;
use App\Containers\Authorization\Models\Role;
use App\Port\Task\Abstracts\Task;

/**
 * Class DetachPermissionsFromRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Actions\GetRoleAction
     */
    private $getRoleAction;


    /**
     * AttachPermissionsToRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Actions\GetRoleAction $getRoleAction
     */
    public function __construct(GetRoleAction $getRoleAction)
    {
        $this->getRoleAction = $getRoleAction;
    }

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
