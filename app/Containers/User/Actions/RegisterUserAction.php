<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\User\Tasks\FireUserCreatedEventTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class RegisterUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        // create user record in the database
        $user = $this->call(CreateUserByCredentialsTask::class,
            [$request->email, $request->password, $request->name, $request->gender, $request->birth]);

        // Fire user created event
        $this->call(FireUserCreatedEventTask::class, [$user]);

        // return the new created user object with access token attached on it
        return $user;
    }
}
