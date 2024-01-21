<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Role;
use Illuminate\Support\Arr;
use League\Fractal\Resource\Collection;

class RoleAdminTransformer extends RoleTransformer
{
    protected array $availableIncludes = [
        'permissions',
    ];

    public function transform(Role $role): array
    {
        return Arr::add(
            parent::transform($role),
            'guard_name',
            $role->guard_name,
        );
    }

    public function includePermissions(Role $role): Collection
    {
        return $this->collection($role->permissions, new PermissionAdminTransformer());
    }
}
