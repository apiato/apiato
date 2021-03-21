<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class DetachPermissionsFromRoleAction extends Action
{
    public function run(DataTransporter $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->role_id]);

        $role = Apiato::call('Authorization@DetachPermissionsFromRoleTask', [$role, $data->permissions_ids]);

        return $role;
    }
}
