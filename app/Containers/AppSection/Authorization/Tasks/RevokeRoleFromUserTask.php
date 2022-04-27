<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Contracts\Auth\Authenticatable;

class RevokeRoleFromUserTask extends ParentTask
{
    /**
     * @param User $user
     * @param string|int|Role $role
     * @return Authenticatable
     */
    public function run(User $user, string|int|Role $role): Authenticatable
    {
        return $user->removeRole($role);
    }
}
