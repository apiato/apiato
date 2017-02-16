<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DeleteRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class DeleteRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\DeleteRoleTask
     */
    private $deleteRoleTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * DeleteRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\DeleteRoleTask $deleteRoleTask
     * @param \App\Containers\Authorization\Tasks\GetRoleTask    $getRoleTask
     */
    public function __construct(DeleteRoleTask $deleteRoleTask, GetRoleTask $getRoleTask)
    {
        $this->deleteRoleTask = $deleteRoleTask;
        $this->getRoleTask = $getRoleTask;
    }

    /**
     * @param $roleNameOrId
     *
     * @return  bool
     */
    public function run($roleNameOrId)
    {
        $role = $this->getRoleTask->run($roleNameOrId);

        $isDeleted = $this->deleteRoleTask->run($role);

        return $isDeleted;
    }
}
