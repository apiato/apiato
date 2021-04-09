<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Ship\Parents\Actions\Action;

class DetachPermissionsFromRoleAction extends Action
{
    public function run(DetachPermissionToRoleRequest $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->role_id]);

        $role = Apiato::call('Authorization@DetachPermissionsFromRoleTask', [$role, $data->permissions_ids]);

        return $role;
    }
}
