<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\RevokeRoleFromUserTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolesFromUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RevokeRolesFromUserAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
        private readonly FindRoleTask $findRoleTask,
        private readonly RevokeRoleFromUserTask $revokeRoleFromUserTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(RevokeRolesFromUserRequest $request): User
    {
        $user = $this->findUserByIdTask->run($request->user_id);
        $rolesIds = (array) $request->roles_ids;

        $roles = array_map(function ($roleId) {
            return $this->findRoleTask->run($roleId);
        }, $rolesIds);

        $this->revokeRoles($user, $roles);

        return $user;
    }

    private function revokeRoles($user, $roles): void
    {
        array_map(function ($role) use ($user) {
            $this->revokeRoleFromUserTask->run($user, $role);
        }, $roles);
    }
}
