<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\UI\API\Requests\RemoveUserRolesRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RemoveUserRolesAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(RemoveUserRolesRequest $request): User
    {
        $user = $this->findUserByIdTask->run($request->user_id);

        foreach ($request->roles_ids as $roleId) {
            $user->removeRole($roleId);
        }

        return $user;
    }
}
