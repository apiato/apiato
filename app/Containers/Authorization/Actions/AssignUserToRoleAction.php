<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class AssignUserToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\AssignUserToRoleTask
     */
    private $assignUserToRoleTask;

    /**
     * AssignUserToRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\AssignUserToRoleTask $assignUserToRoleTask
     */
    public function __construct(AssignUserToRoleTask $assignUserToRoleTask)
    {
        $this->assignUserToRoleTask = $assignUserToRoleTask;
    }

    /**
     * @param $userId
     * @param $rolesNames array or string
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userId, $rolesNames)
    {
        return $this->assignUserToRoleTask->run($userId, $rolesNames);
    }
}
