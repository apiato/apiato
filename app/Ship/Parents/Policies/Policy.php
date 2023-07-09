<?php

namespace App\Ship\Parents\Policies;

use Apiato\Core\Abstracts\Policies\Policy as AbstractPolicy;
use App\Ship\Parents\Models\UserModel;

abstract class Policy extends AbstractPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(UserModel $user, string $ability): ?bool
    {
        // grant access for admins
        if (method_exists($user, 'hasAdminRole') && $user->hasAdminRole()) {
            return true;
        }

        return null;
    }
}
