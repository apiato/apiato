<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;

class AssignUserToRoleTask extends Task
{
    public function run(User $user, array $roles): Authenticatable
    {
        return $user->assignRole($roles);
    }
}
