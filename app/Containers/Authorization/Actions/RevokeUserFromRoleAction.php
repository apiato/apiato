<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RevokeUserFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(DataTransporter $data): User
    {
        // if user ID is passed then convert it to instance of User (could be user Id Or Model)
        if (!$data->user_id instanceof User) {
            $user = Apiato::call('User@FindUserByIdTask', [$data->user_id]);
        }

        // convert to array in case single ID was passed (could be Single Or Multiple Role Ids)
        $rolesIds = (array)$data->roles_ids;

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
