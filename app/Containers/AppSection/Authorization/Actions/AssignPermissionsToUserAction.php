<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authorization\Tasks\AssignPermissionsToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignPermissionsToUserRequest;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;

class AssignPermissionsToUserAction extends ParentAction
{
    /**
     * @param AssignPermissionsToUserRequest $request
     * @return User
     */
    public function run(AssignPermissionsToUserRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->user_id);

        $permissionIds = (array)$request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $permissionIds);

        return app(AssignPermissionsToUserTask::class)->run($user, $permissions);
    }
}
