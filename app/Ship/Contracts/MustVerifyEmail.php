<?php

namespace App\Ship\Contracts;

use Illuminate\Contracts\Auth\MustVerifyEmail as LaravelMustVerifyEmail;

interface MustVerifyEmail extends LaravelMustVerifyEmail
{
    /**
     * Send the email verification notification with frontend verification url.
     */
    public function sendEmailVerificationNotificationWithVerificationUrl(string $verificationUrl): void;
}
