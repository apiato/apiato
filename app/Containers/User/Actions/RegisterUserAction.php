<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\CreateUserByCredentialsTask;
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
        // create user record in the database and return it.
        return $this->call(CreateUserByCredentialsTask::class, [
            $isClient = true,
            $request->email,
            $request->password,
            $request->name,
            $request->gender,
            $request->birth
        ]);
    }
}
