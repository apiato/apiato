<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AssignRoleTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class AssignRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\AssignRoleTask
     */
    private $assignRoleTask;

    /**
     * GetAdminRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\AssignRoleTask $assignRoleTask
     */
    public function __construct(AssignRoleTask $assignRoleTask)
    {
        $this->assignRoleTask = $assignRoleTask;
    }

    /**
     * @param $userId
     * @param $roleName
     */
    public function run($userId, $roleName)
    {
        return $this->assignRoleTask->run($userId, $roleName);
    }
}
