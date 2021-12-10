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
        return hash_equals((string)$this->user()->getKey(), (string)$this->id);
    }
}
