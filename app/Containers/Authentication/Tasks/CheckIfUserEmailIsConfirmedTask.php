<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class CheckIfUserEmailIsConfirmedTask extends Task
{
    public function run(User $user): bool
    {
        if ($this->emailConfirmationIsRequired()) {
            return (bool)$user->confirmed;
        }

        return true;
    }

    private function emailConfirmationIsRequired()
    {
        return Config::get('authentication-container.require_email_confirmation');
    }
}
