<?php

namespace App\Containers\AppSection\User\Contracts\Transformers;

use App\Containers\AppSection\User\Models\User;
use League\Fractal\Resource\Collection;

interface IncludeRoles
{
    public function includeRoles(User $user): Collection;
}
