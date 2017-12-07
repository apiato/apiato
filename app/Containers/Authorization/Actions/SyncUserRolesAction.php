<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class SyncUserRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncUserRolesAction extends Action
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

        // convert roles IDs to array (in case single id passed)
        $rolesIds = (array)$singleOrMultipleRoleIds;

        $roles = array_map(function($roleId){
            return Apiato::call('Authorization@FindRoleTask', [$roleId]);
        }, $rolesIds);

        $user->syncRoles($roles);

        return $user;
    }
}
