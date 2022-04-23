<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CreatePasswordResetTokenTask extends ParentTask
{
    public function run(UserModel $user): string
    {
        return app('auth.password.broker')->createToken($user);
    }
}
