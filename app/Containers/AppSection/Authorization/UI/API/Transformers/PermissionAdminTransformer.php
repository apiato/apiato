<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Permission;
use Illuminate\Support\Arr;

class PermissionAdminTransformer extends PermissionTransformer
{
    protected array $availableIncludes = [];

    public function transform(Permission $permission): array
    {
        return Arr::add(
            parent::transform($permission),
            'guard_name',
            $permission->guard_name,
        );
    }
}
