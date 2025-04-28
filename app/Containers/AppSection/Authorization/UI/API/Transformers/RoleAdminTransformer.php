<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Role;
use Illuminate\Support\Arr;

class RoleAdminTransformer extends RoleTransformer
{
    #[\Override]
    public function transform(Role $role): array
    {
        return Arr::add(
            parent::transform($role),
            'guard_name',
            $role->guard_name,
        );
    }
}
