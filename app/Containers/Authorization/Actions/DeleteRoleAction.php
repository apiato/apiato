<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DeleteRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleAction extends Action
{
    /**
     * @param $roleNameOrId
     *
     * @return  bool
     */
    public function run($roleNameOrId)
    {
        $role = $this->call(GetRoleTask::class, [$roleNameOrId]);
        $this->call(DeleteRoleTask::class, [$role]);

        return $role;
    }
}
