<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleRequest;
use App\Ship\Parents\Actions\Action;

class FindRoleAction extends Action
{
    public function run(FindRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->id);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }
}
