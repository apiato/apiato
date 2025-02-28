<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class SyncUserRolesAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    public function run(int $userId, int ...$roleIds): User
    {
        return $this->findUserByIdTask->run($userId)
            ->syncRoles($roleIds);
    }
}
