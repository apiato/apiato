<?php

namespace App\Containers\AppSection\Authorization\Traits;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Contracts\Auth\Authenticatable;

trait AuthorizationTrait
{
    public function hasAdminRole(): bool
    {
        return $this->hasRole('admin');
    }
}
