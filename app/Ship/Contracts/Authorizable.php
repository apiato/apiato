<?php

namespace App\Ship\Contracts;

interface Authorizable
{
    public function hasAdminRole(): bool;
}
