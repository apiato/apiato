<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RevokeUserFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(Request $request): User
    {
        // if user ID is passed then convert it to instance of User
        if (!$request->user_id instanceof User) {
            $user = Apiato::call('User@FindUserByIdTask', [$request->user_id]);
        }

        if (!is_array($rolesIds = $request->roles_ids)) {
            $rolesIds = [$rolesIds];
        }

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
