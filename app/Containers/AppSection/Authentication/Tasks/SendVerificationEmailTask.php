<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Tasks\Task;

class SendVerificationEmailTask extends Task
{
    public function run(UserModel $user): void
    {
        if (config('appSection-authentication.require_email_verification') && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
    }
}
