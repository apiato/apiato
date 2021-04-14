<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class CheckIfUserEmailIsConfirmedTask extends Task
{
    public function run(User $user): bool
    {
        if ($this->emailConfirmationIsRequired()) {
            return !is_null($user->email_verified_at);
        }

        return true;
    }

    private function emailConfirmationIsRequired()
    {
        return config('appSection-authentication.require_email_confirmation');
    }
}
