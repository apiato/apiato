<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Models\Role;
use App\Ship\Task\Abstracts\Task;

/**
 * Class AttachPermissionsToRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleTask extends Task
{

    /**
     * @param \App\Containers\Authorization\Models\Role $role
     * @param array                                     $permissions
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(Role $role, Array $permissions)
    {
        $role = $role->givePermissionTo($permissions);

        return $role;
    }
}
