<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class FindRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return Role
     * @throws \App\Containers\Authorization\Exceptions\RoleNotFoundException
     */
    public function run(Request $request): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$roleId = $request->id]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
