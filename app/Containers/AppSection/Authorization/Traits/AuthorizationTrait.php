<?php

namespace App\Containers\AppSection\Authorization\Traits;

trait AuthorizationTrait
{
    public function hasAdminRole(): bool
    {
        return $this->hasRole('admin');
    }
}
