<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AttachPermissionsToRoleTask;
use App\Containers\Authorization\Tasks\GetPermissionTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class AttachPermissionsToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\AttachPermissionsToRoleTask
     */
    private $attachPermissionsToRoleTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\GetPermissionTask
     */
    private $getPermissionTask;

    /**
     * AttachPermissionsToRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\AttachPermissionsToRoleTask $attachPermissionsToRoleTask
     * @param \App\Containers\Authorization\Tasks\GetRoleTask                 $getRoleTask
     */
    public function __construct(
        AttachPermissionsToRoleTask $attachPermissionsToRoleTask,
        GetRoleTask $getRoleTask,
        GetPermissionTask $getPermissionTask
    ) {
        $this->attachPermissionsToRoleTask = $attachPermissionsToRoleTask;
        $this->getRoleTask = $getRoleTask;
        $this->getPermissionTask = $getPermissionTask;
    }

    /**
     * @param $roleId
     * @param $permissionsIds
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run($roleId, $permissionsIds)
    {
        $role = $this->getRoleTask->run($roleId);

        $permissions = [];

        if (is_array($permissionsIds)) {
            foreach ($permissionsIds as $permissionId){
                $permissions[] = $this->getPermissionTask->run($permissionId);
            }
        }else{
            $permissions[] = $this->getPermissionTask->run($permissionsIds);
        }

        return $this->attachPermissionsToRoleTask->run($role, $permissions);
    }
}
