<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Role;
use Illuminate\Support\Arr;

final class RoleAdminTransformer extends RoleTransformer
{
    public function transform(Role $role): array
    {
        return Arr::add(
            parent::transform($role),
            'guard_name',
            $role->guard_name,
        );
    }
}
