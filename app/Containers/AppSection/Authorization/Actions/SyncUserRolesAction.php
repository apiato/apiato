<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

class SyncUserRolesAction extends Action
{
    public function run(SyncUserRolesRequest $request): User
    {
        $user = Apiato::call(FindUserByIdTask::class, [$request->user_id]);

        // convert roles IDs to array (in case single id passed)
        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return Apiato::call(FindRoleTask::class, [$roleId]);
        }, $rolesIds);

        $user->syncRoles($roles);

        return $user;
    }
}
