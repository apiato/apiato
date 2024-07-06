<?php

namespace App\Containers\AppSection\User\Contracts\Transformers;

use App\Containers\AppSection\User\Models\User;
use League\Fractal\Resource\Collection;

interface IncludePermissions
{
    public function includePermissions(User $user): Collection;
}
