<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifyEmailTask extends Task
{
    public function run(MustVerifyEmail $verifiable, string|null $email): void
    {
        if (null !== $email && $this->shouldVerifyEmail($verifiable, $email)) {
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
