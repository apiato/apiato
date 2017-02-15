<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DeleteRoleTask;
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
     * DeleteRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\DeleteRoleTask $deleteRoleTask
     */
    public function __construct(DeleteRoleTask $deleteRoleTask)
    {
        $this->deleteRoleTask = $deleteRoleTask;
    }

    /**
     * @param $roleId
     *
     * @return  bool
     */
    public function run($roleId = null)
    {
        $isDeleted = $this->deleteRoleTask->run($roleId);

        return $isDeleted;
    }
}
