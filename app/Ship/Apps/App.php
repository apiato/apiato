<?php

declare(strict_types=1);

namespace App\Ship\Apps;

interface App
{
    public function url(): string;

    public function verifyEmailUrl(): string;

    public function resetPasswordUrl(): string;
}
