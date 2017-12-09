<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateAdminAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(Request $request): User
    {
        $admin = Apiato::call('User@CreateUserByCredentialsTask', [
            $isClient = false,
            $request->email,
            $request->password,
            $request->name
        ]);

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_client=false`).
        Apiato::call('Authorization@AssignUserToRoleTask', [$admin, ['admin']]);

        return $admin;
    }
}
