<?php

namespace App\Containers\AppSection\Authorization\Traits;

trait IsResourceOwnerTrait
{
    /**
     * Check if the submitted ID (mainly URL ID's) is the same as
     * the authenticated user ID (based on the user Token).
     */
    public function isResourceOwner(): bool
    {
        if ($this->user()->hasAnyRole(config('apiato.requests.allow-roles-to-access-all-routes'))) {
            return true;
        }

        return hash_equals((string) $this->user()->getKey(), (string) $this->id);
    }
}
