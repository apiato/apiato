<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class AssignUserToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = Apiato::call('User@FindUserByIdTask', [$request->user_id]);

        $roles = [];

        // convert roles IDs to array (in case single id passed)
        if (!is_array($rolesIds = $request->roles_ids)) {
            $rolesIds = [$request->roles_ids];
        }

        foreach ($rolesIds as $roleId) {
            $roles[] = Apiato::call('Authorization@FindRoleTask', [$roleId]);
        }

        return Apiato::call('Authorization@AssignUserToRoleTask', [$user, $roles]);
    }
}
