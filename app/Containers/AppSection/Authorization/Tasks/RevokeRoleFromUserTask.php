<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;

class RevokeRoleFromUserTask extends Task
{
    public function run(User $user, string|int|Role $role): Authenticatable
    {
        return $user->removeRole($role);
    }
}
