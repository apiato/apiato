<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Permission;
use Illuminate\Support\Arr;
use League\Fractal\Resource\Collection;

class PermissionAdminTransformer extends PermissionTransformer
{
    protected array $availableIncludes = [
        'roles',
    ];

    public function transform(Permission $permission): array
    {
        return Arr::add(
            parent::transform($permission),
            'guard_name',
            $permission->guard_name,
        );
    }

    public function includeRoles(Permission $permission): Collection
    {
        return $this->collection($permission->roles, new RoleAdminTransformer());
    }
}
