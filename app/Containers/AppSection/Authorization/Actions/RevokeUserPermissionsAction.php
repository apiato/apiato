<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RevokeUserPermissionsAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    public function run(int $userId, int ...$permissionIds): User
    {
        $user = $this->findUserByIdTask->run($userId);

        foreach ($permissionIds as $permissionId) {
            $user->revokePermissionTo($permissionId);
        }

        return $user;
    }
}
