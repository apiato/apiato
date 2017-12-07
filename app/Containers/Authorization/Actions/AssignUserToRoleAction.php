<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;

/**
 * Class AssignUserToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleAction extends Action
{

    /**
     * @param $userId
     * @param $singleOrMultipleRoleIds
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userId, $singleOrMultipleRoleIds): User
    {
        $user = Apiato::call('User@FindUserByIdTask', [$userId]);

        // convert to array in case single ID was passed
        $rolesIds = (array)$singleOrMultipleRoleIds;

        $roles = array_map(function ($roleId) {
            return Apiato::call('Authorization@FindRoleTask', [$roleId]);
        }, $rolesIds);

        $user = Apiato::call('Authorization@AssignUserToRoleTask', [$user, $roles]);

        return $user;
    }
}
