<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class CreateAdminAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminAction extends Action
{

    /**
     * @param string $email
     * @param string $password
     * @param string $name
     * @param bool   $isClient
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(string $email, string $password, string $name, bool $isClient = false): User
    {
        $admin = Apiato::call('User@CreateUserByCredentialsTask', [
            $isClient,
            $email,
            $password,
            $name
        ]);

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_client=false`).
        Apiato::call('Authorization@AssignUserToRoleTask', [$admin, ['admin']]);

        return $admin;
    }
}
