<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Actions\GetRoleAction;
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
     * @param string       $roleName
     * @param array|string $permissionNames
     *
     * @return  mixed
     */
    public function run($roleName, $permissionNames)
    {
        $role = $this->getRoleAction->run($roleName);

        $role->revokePermissionTo($permissionNames);

        return $role;
    }
}
