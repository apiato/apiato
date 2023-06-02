<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;

class AssignRolesToUserTask extends ParentTask
{
    public function run(User $user, Role|array|int|string $roles): User
    {
        return $user->assignRole($roles);
    }
}
