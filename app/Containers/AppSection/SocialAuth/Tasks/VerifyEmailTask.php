<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class VerifyEmailTask extends Task
{
    public function run(Model|MustVerifyEmail $verifiable, ?string $email): void
    {
        if ($this->shouldVerifyEmail($verifiable, $email)) {
            $verifiable->markEmailAsVerified();
        }
    }

    private function shouldVerifyEmail(MustVerifyEmail $verifiable, ?string $email): bool
    {
        if (SocialAuth::$verifiesEmail && null !== $email) {
            return $this->isEmailMatching($verifiable, $email) && !$verifiable->hasVerifiedEmail();
        }

        return false;
    }

    private function isEmailMatching(MustVerifyEmail $verifiable, string $email): bool
    {
        return $verifiable->getEmailForVerification() === $email;
    }
}
