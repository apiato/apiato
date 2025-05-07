<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class GivePermissionsToUserAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    public function run(int $userId, int ...$permissionIds): User
    {
        return $this->findUserByIdTask->run($userId)
            ->givePermissionTo($permissionIds);
    }
}
