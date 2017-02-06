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
     * @var  \App\Containers\Authorization\Tasks\AssignRoleTask
     */
    private $assignRoleTask;

    /**
     * AssignRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\AssignRoleTask $assignRoleTask
     */
    public function __construct(AssignRoleTask $assignRoleTask)
    {
        $this->assignRoleTask = $assignRoleTask;
    }

    /**
     * @param $userId
     * @param $rolesNames array or string
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userId, $rolesNames)
    {
        return $this->assignRoleTask->run($userId, $rolesNames);
    }
}
