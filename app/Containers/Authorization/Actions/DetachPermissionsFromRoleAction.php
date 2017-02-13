<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Port\Action\Abstracts\Action;

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
     * DetachPermissionsFromRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask $detachPermissionsFromRoleTask
     */
    public function __construct(DetachPermissionsFromRoleTask $detachPermissionsFromRoleTask)
    {
        $this->detachPermissionsFromRoleTask = $detachPermissionsFromRoleTask;
    }

    /**
     * @param string       $role
     * @param array|string $permissions
     *
     * @return  mixed
     */
    public function run($role, $permissions)
    {
        return $this->detachPermissionsFromRoleTask->run($role, $permissions);
    }
}
