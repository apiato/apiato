<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class AssignRolesToUserAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
        private readonly FindRoleTask $findRoleTask,
        private readonly AssignRolesToUserTask $assignRolesToUserTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(AssignRolesToUserRequest $request): User
    {
        $user = $this->findUserByIdTask->run($request->user_id);

        $rolesIds = (array) $request->roles_ids;

        $roles = array_map(function ($roleId) {
            return $this->findRoleTask->run($roleId);
        }, $rolesIds);

        return $this->assignRolesToUserTask->run($user, $roles);
    }
}
