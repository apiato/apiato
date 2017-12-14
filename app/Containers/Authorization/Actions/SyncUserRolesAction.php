<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Transporters\Transporter;

/**
 * Class SyncUserRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncUserRolesAction extends Action
{

    /**
     * @param \App\Ship\Parents\Transporters\Transporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(Transporter $data): User
    {
        $user = Apiato::call('User@FindUserByIdTask', [$data->user_id]);

        // convert roles IDs to array (in case single id passed)
        $rolesIds = (array)$data->roles_ids;

        $roles = array_map(function ($roleId) {
            return Apiato::call('Authorization@FindRoleTask', [$roleId]);
        }, $rolesIds);

        $user->syncRoles($roles);

        return $user;
    }
}
