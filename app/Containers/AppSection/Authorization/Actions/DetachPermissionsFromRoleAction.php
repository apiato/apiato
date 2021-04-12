<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Ship\Parents\Actions\Action;

class DetachPermissionsFromRoleAction extends Action
{
    public function run(DetachPermissionToRoleRequest $request): Role
    {
        $role = Apiato::call(FindRoleTask::class, [$request->role_id]);
        return Apiato::call(DetachPermissionsFromRoleTask::class, [$role, $request->permissions_ids]);
    }
}
