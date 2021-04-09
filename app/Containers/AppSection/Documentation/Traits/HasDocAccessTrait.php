<?php

namespace App\Containers\AppSection\Documentation\Traits;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;

trait HasDocAccessTrait
{
    /**
     * Check if the authenticated user has proper
     * roles/permissions to access the private docs
     */
    public function hasDocAccess(): bool
    {
        if (config('documentation-container.protect-private-docs')) {
            /** @var User|null $user */
            $user = Apiato::call('Authentication@GetAuthenticatedUserTask');
            if ($user !== null) {
                if ($user->hasAnyRole(['admin'])) {
                    return true;
                }
                if ($user->checkPermissionTo('access-private-docs')) {
                    return true;
                }
            }
            return false;
        }

        return true;
    }
}
