<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
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
     * @param      $email
     * @param      $password
     * @param null $name
     * @param null $gender
     * @param null $birth
     *
     * @return  mixed
     */
    public function run($email, $password, $name = null, $gender = null, $birth = null)
    {
        // create user record in the datbase
        $user = $this->call(CreateUserByCredentialsTask::class, [$email, $password, $name, $gender, $birth]);

        // Set default permissions on the new user
        // $this->call(AssignUserToRoleAction::class, [$user, ['manager', '...']]);

        // Creating an access token without scopes, and attach it to the new user
        $user->attachAccessToken($email);

        // Fire user created event
        $this->call(FireUserCreatedEventTask::class, [$user]);

        // return the new created user object with access token attached on it
        return $user;
    }
}
