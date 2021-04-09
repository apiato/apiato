<?php

namespace App\Containers\AppSection\Authorization\Traits;

use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthorizationTrait
{
    public function getUser(): ?User
    {
        return Auth::user();
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
