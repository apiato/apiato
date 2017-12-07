<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class FindRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleAction extends Action
{

    /**
     * @param $roleId
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run($roleId): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$roleId]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
