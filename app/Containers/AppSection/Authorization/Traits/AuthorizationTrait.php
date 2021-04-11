<?php

namespace App\Containers\AppSection\Authorization\Traits;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use Illuminate\Contracts\Auth\Authenticatable;

trait AuthorizationTrait
{
    public function getUser(): ?Authenticatable
    {
        return Apiato::call(GetAuthenticatedUserTask::class);
    }

    public function hasAdminRole(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Return the "highest" role of a user (0 if the user does not have any role)
     */
    public function getRoleLevel(): int
    {
        return ($role = $this->roles()->orderBy('level', 'DESC')->first()) ? $role->level : 0;
    }
}
