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
    /**
     * @param AttachPermissionsToUserRequest $request
     * @return User
     * @throws NotFoundException
     */
    public function run(AttachPermissionsToUserRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->id);

        $permissionIds = (array)$request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $permissionIds);

        return $user->givePermissionTo($permissions);
    }
}
