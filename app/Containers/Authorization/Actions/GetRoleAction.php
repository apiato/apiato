<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     * @throws \App\Containers\Authorization\Exceptions\RoleNotFoundException
     */
    public function run(Request $request)
    {
        $role = Apiato::call('Authorization@GetRoleTask', [$roleId = $request->id]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
