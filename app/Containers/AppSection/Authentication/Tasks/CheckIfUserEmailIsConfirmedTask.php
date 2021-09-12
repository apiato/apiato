<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class CheckIfUserEmailIsConfirmedTask extends Task
{
    public function run(User $user): bool
    {
        if ($this->emailConfirmationRequired()) {
            return $this->isEmailConfirmed($user);
        }

        return true;
    }

    private function emailConfirmationRequired()
    {
        return config('appSection-authentication.require_email_confirmation');
    }

    private function isEmailConfirmed(User $user): bool
    {
        return !is_null($user->email_verified_at);
    }
}
