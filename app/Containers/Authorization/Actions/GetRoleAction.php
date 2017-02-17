<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Parents\Actions\Action;
use phpDocumentor\Reflection\Types\Integer;

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
     * @param Integer|String $roleNameOrId
     *
     * @return  mixed
     */
    public function run($roleNameOrId)
    {
        $role = $this->getRoleTask->run($roleNameOrId);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
