<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\SyncPermissionsOnRoleTask;
use App\Containers\Authorization\Tasks\GetPermissionTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class SyncPermissionsOnRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncPermissionsOnRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\SyncPermissionsOnRoleTask
     */
    private $syncPermissionsOnRoleTask;

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
     * @param \App\Containers\Authorization\Tasks\SyncPermissionsOnRoleTask $syncPermissionsOnRoleTask
     * @param \App\Containers\Authorization\Tasks\GetRoleTask                 $getRoleTask
     */
    public function __construct(
        SyncPermissionsOnRoleTask $syncPermissionsOnRoleTask,
        GetRoleTask $getRoleTask,
        GetPermissionTask $getPermissionTask
    ) {
        $this->syncPermissionsOnRoleTask = $syncPermissionsOnRoleTask;
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

        return $this->syncPermissionsOnRoleTask->run($role, $permissions);
    }
}
