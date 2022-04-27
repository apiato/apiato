<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Contracts\Auth\Authenticatable;

class AssignRolesToUserTask extends ParentTask
{
    /**
     * @param User $user
     * @param array|int|string|Role $roles
     * @return Authenticatable
     */
    public function run(User $user, Role|array|int|string $roles): Authenticatable
    {
        return $user->assignRole($roles);
    }
}
