<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleAction extends Action
{

    /**
     * @param string $roleId
     *
     * @return  mixed
     */
    public function run($roleId): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$roleId]);

        Apiato::call('Authorization@DeleteRoleTask', [$role]);

        return $role;
    }
}
