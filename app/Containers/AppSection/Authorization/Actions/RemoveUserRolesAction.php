<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RemoveUserRolesAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    public function run(int $userId, int ...$roleIds): User
    {
        $user = $this->findUserByIdTask->run($userId);

        foreach ($roleIds as $roleId) {
            $user->removeRole($roleId);
        }

        return $user;
    }
}
