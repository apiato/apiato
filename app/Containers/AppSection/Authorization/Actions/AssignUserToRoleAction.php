<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

class AssignUserToRoleAction extends Action
{
    public function run(AssignUserToRoleRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->user_id);

        // convert to array in case single ID was passed
        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return app(FindRoleTask::class)->run($roleId);
        }, $rolesIds);

        return app(AssignUserToRoleTask::class)->run($user, $roles);
    }
}
