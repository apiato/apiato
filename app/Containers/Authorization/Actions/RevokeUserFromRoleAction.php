<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RevokeUserFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleAction extends Action
{

    /**
     * @param $userIdOrModel
     * @param $singleOrMultipleRoleIds
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userIdOrModel, $singleOrMultipleRoleIds): User
    {
        // if user ID is passed then convert it to instance of User
        if (!$userIdOrModel instanceof User) {
            $user = Apiato::call('User@FindUserByIdTask', [$userIdOrModel]);
        }

        // convert to array in case single ID was passed
        $rolesIds = (array)$singleOrMultipleRoleIds;

        $roles = new Collection();

        foreach ($rolesIds as $roleId) {
            $role = Apiato::call('Authorization@FindRoleTask', [$roleId]);
            $roles->add($role);
        }

        foreach ($roles->pluck('name')->toArray() as $roleName) {
            $user->removeRole($roleName);
        }

        return $user;
    }
}
