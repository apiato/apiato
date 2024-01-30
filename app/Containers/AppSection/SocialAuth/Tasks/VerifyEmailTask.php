<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifyEmailTask extends Task
{
    public function run(MustVerifyEmail $verifiable, string|null $email): void
    {
        // TODO: $email here can be null sometimes.
        // If we let it be null, then what will happen in isEmailMatching()?
        // What if user doesn't have an email already? Then it returns true!
        if ($this->shouldVerifyEmail($verifiable, $email)) {
            $verifiable->markEmailAsVerified();
        }
    }

    private function shouldVerifyEmail(MustVerifyEmail $verifiable, string $email): bool
    {
        return $this->isEmailMatching($verifiable, $email) && !$verifiable->hasVerifiedEmail();
    }

    private function isEmailMatching(MustVerifyEmail $verifiable, string $email): bool
    {
        return $verifiable->getEmailForVerification() === $email;
    }
}
