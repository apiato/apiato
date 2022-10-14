<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;

class DetachPermissionsFromUserTask extends ParentTask
{
    /**
     * @param User $user
     * @param Permission[] $permissions
     * @return User
     */
    public function run(User $user, array $permissions): User
    {
        array_map(static function ($permission) use ($user) {
            $user->revokePermissionTo($permission);
        }, $permissions);

        return $user;
    }
}
