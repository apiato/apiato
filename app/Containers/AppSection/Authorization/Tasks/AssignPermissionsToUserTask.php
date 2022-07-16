<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Contracts\Auth\Authenticatable;

class AssignPermissionsToUserTask extends ParentTask
{
    /**
     * @param User $user
     * @param array|int|string|Permission $permissions
     * @return Authenticatable
     */
    public function run(User $user, Permission|array|int|string $permissions): Authenticatable
    {
        return $user->givePermissionTo($permissions);;
    }
}
