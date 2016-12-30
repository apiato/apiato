<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class GetRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * GetRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\GetRoleTask $getRoleTask
     */
    public function __construct(GetRoleTask $getRoleTask)
    {
        $this->getRoleTask = $getRoleTask;
    }

    /**
     * @param $roleName
     *
     * @return  mixed
     * @throws \App\Containers\Authorization\Exceptions\RoleNotFoundException
     */
    public function run($roleName)
    {
        $role = $this->getRoleTask->run($roleName);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
