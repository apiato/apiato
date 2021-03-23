<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Parents\Actions\Action;
use Spatie\Permission\Contracts\Role;

class DeleteRoleAction extends Action
{
    public function run(DeleteRoleRequest $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->id]);

        Apiato::call('Authorization@DeleteRoleTask', [$role]);

        return $role;
    }
}
