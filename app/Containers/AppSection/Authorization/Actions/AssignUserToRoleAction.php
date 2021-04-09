<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action;

class AssignUserToRoleAction extends Action
{
    public function run(AssignUserToRoleRequest $data): User
    {
        $user = Apiato::call('User@FindUserByIdTask', [$data->user_id]);

        // convert to array in case single ID was passed
        $rolesIds = (array)$data->roles_ids;

        $roles = array_map(function ($roleId) {
            return Apiato::call('Authorization@FindRoleTask', [$roleId]);
        }, $rolesIds);

        $user = Apiato::call('Authorization@AssignUserToRoleTask', [$user, $roles]);

        return $user;
    }
}
