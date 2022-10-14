<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\AppSection\Authorization\Tasks\DetachPermissionsFromUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DetachPermissionsFromUserAction extends ParentAction
{
    /**
     * @param DetachPermissionsFromUserRequest $request
     * @return User
     * @throws NotFoundException
     */
    public function run(DetachPermissionsFromUserRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->id);

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $request->permissions_ids);

        return app(DetachPermissionsFromUserTask::class)->run($user, $permissions);
    }
}
