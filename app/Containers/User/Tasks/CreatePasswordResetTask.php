<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;

class CreatePasswordResetTask extends Task
{

    public function __construct()
    {
        // ..
    }

    public function run(User $user)
    {
        try {
            return app('auth.password.broker')->createToken($user);
        } catch (Exception $e) {
            throw new CreateResourceFailedException;
        }
    }
}
