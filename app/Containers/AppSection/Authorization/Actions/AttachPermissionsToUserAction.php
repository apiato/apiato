<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class AttachPermissionsToUserAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
        private readonly FindPermissionTask $findPermissionTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(AttachPermissionsToUserRequest $request): User
    {
        $user = $this->findUserByIdTask->run($request->id);

        $permissionIds = (array) $request->permissions_ids;

        $permissions = array_map(function ($permissionId) {
            return $this->findPermissionTask->run($permissionId);
        }, $permissionIds);

        return $user->givePermissionTo($permissions);
    }
}
