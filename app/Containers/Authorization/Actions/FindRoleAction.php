<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\UI\API\Requests\FindRoleRequest;
use App\Ship\Parents\Actions\Action;

class FindRoleAction extends Action
{
    public function run(FindRoleRequest $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->id]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }
}
