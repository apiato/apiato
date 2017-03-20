<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\Authorization\Tasks\RevokeUserFromRoleTask;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RevokeUserFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleAction extends Action
{
    /**
     * @param User|integer  $userId
     * @param integer|array $rolesIds
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

        $roles = new Collection();

        foreach ($rolesIds as $roleId) {
            $role = $this->call(GetRoleTask::class, [$roleId]);
            $roles->add($role);
        }

        return $this->call(revokeUserFromRoleTask::class, [$user, $roles->pluck('name')->toArray()]);
    }
}
