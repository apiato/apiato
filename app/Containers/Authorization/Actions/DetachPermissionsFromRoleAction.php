<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;

/**
 * Class DetachPermissionsFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleAction extends Action
{

    /**
     * @param $roleId
     * @param $permissionsIds
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run($roleId, $permissionsIds): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$roleId]);

        return Apiato::call('Authorization@DetachPermissionsFromRoleTask', [$role, $permissionsIds]);
    }
}
