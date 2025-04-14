<?php

namespace App\Ship\Apps;

final readonly class Web implements App
{
    public function url(): string
    {
        return config()->string('apiato.apps.web.url');
    }

    public function verifyEmailUrl(): string
    {
        return $this->url() . '/email/verify';
    }

    public function resetPasswordUrl(): string
    {
        return $this->url() . '/reset-password';
    }
}
