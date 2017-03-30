<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\User\Tasks\FireUserCreatedEventTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserAction extends Action
{

    /**
     * Create a new user object. Optionally can login the created user and return it with its token.
     *
     * @param      $email
     * @param      $password
     * @param      $name
     * @param      $gender
     * @param      $birth
     * @param bool $login determine weather to login or not after creating
     *
     * @return mixed
     */
    public function run($email, $password, $name, $gender = null, $birth = null, $login = false)
    {
        $user = $this->call(CreateUserByCredentialsTask::class, [$email, $password, $name, $gender, $birth, $login]);

        // example for how to set default permissions on every new user created.
        // $this->call(AssignUserToRoleAction::class, [$user, ['client', 'developer']]);

        //  add Client as role for normal users
        $this->call(FireUserCreatedEventTask::class, [$user]);

        return $user;
    }
}
