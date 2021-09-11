<?php

namespace App\Containers\AppSection\User\Traits;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Exceptions\NotFoundException;

trait IsOwnerTrait
{
    /**
     * Check if the submitted ID (mainly URL ID's) is the same as
     * the authenticated user ID (based on the user Token).
     * @throws NotFoundException
     */
    public function isOwner(): bool
    {
        $user = app(GetAuthenticatedUserTask::class)->run();
        return $user->id === $this->id;
    }
}
