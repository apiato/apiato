<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\Permission\Contracts\Role;

class AssignRolesToUserTask extends Task
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
