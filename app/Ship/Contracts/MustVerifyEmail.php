<?php

namespace App\Ship\Contracts;

interface MustVerifyEmail extends \Illuminate\Contracts\Auth\MustVerifyEmail
{
    /**
     * Send the email verification notification with frontend verification url.
     *
     * @return void
     */
    public function sendEmailVerificationNotificationWithVerificationUrl(string $verificationUrl);
}
