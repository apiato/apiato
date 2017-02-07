<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AttachPermissionsToRoleTask;
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
     * AttachPermissionsToRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\AttachPermissionsToRoleTask $attachPermissionsToRoleTask
     */
    public function __construct(AttachPermissionsToRoleTask $attachPermissionsToRoleTask)
    {
        $this->attachPermissionsToRoleTask = $attachPermissionsToRoleTask;
    }

    /**
     * @param string       $role
     * @param array|string $permissions
     *
     * @return  mixed
     */
    public function run($role, $permissions)
    {
        return $this->attachPermissionsToRoleTask->run($role, $permissions);
    }
}
