<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

interface Authorizable
{
    public function hasAdminRole(): bool;
}
