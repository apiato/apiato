<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\DetachPermissionsFromUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DetachPermissionsFromUserAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
        private readonly FindPermissionTask $findPermissionTask,
        private readonly DetachPermissionsFromUserTask $detachPermissionsFromUserTask
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(DetachPermissionsFromUserRequest $request): User
    {
        $user = $this->findUserByIdTask->run($request->id);

        $permissions = array_map(function ($permissionId) {
            return $this->findPermissionTask->run($permissionId);
        }, $request->permissions_ids);

        return $this->detachPermissionsFromUserTask->run($user, $permissions);
    }
}
