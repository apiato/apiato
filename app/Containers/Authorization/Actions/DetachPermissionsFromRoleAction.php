<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Action\Abstracts\Action;

/**
 * Class DetachPermissionsFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask
     */
    private $detachPermissionsFromRoleTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * DetachPermissionsFromRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask $detachPermissionsFromRoleTask
     * @param \App\Containers\Authorization\Tasks\GetRoleTask                   $getRoleTask
     */
    public function __construct(DetachPermissionsFromRoleTask $detachPermissionsFromRoleTask, GetRoleTask $getRoleTask)
    {
        $this->detachPermissionsFromRoleTask = $detachPermissionsFromRoleTask;
        $this->getRoleTask = $getRoleTask;
    }

    /**
     * @param $roleId
     * @param $permissions
     *
     * @return  mixed
     */
    public function run($roleId, $permissionsIds)
    {
        $role = $this->getRoleTask->run($roleId);

        return $this->detachPermissionsFromRoleTask->run($role, $permissionsIds);
    }
}
