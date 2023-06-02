<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Auth\Passwords\PasswordBroker;

class CreatePasswordResetTokenTask extends ParentTask
{
    public function __construct(
        private readonly PasswordBroker $passwordBroker,
    ) {
    }

    public function run(UserModel $user): string
    {
        return $this->passwordBroker->createToken($user);
    }
}
