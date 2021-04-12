<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleRequest;
use App\Ship\Parents\Actions\Action;

class FindRoleAction extends Action
{
    /**
     * @throws RoleNotFoundException
     */
    public function run(FindRoleRequest $request): Role
    {
        $role = Apiato::call(FindRoleTask::class, [$request->id]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }
}
