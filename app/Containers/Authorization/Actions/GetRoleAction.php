<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetRoleAction extends Action
{

    /**
     * @param Integer|String $roleNameOrId
     *
     * @return  mixed
     */
    public function run($roleNameOrId)
    {
        $role = $this->call(GetRoleTask::class, [$roleNameOrId]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
