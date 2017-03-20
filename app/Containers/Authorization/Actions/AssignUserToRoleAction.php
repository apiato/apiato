<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class AssignUserToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleAction extends Action
{
    /**
     * @param $user
     * @param $rolesIds
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($user, $rolesIds)
    {
        if (!$user instanceof User) {
            $user = $this->call(FindUserByIdTask::class, [$user]);
        }

        if (!is_array($rolesIds)) {
            $rolesIds = [$rolesIds];
        }

        foreach ($rolesIds as $roleId) {
            $roles[] = $this->call(GetRoleTask::class, [$roleId]);
        }

        return $this->call(AssignUserToRoleTask::class, [$user, $roles]);
    }
}
