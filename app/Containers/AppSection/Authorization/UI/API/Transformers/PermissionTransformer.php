<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class PermissionTransformer extends ParentTransformer
{
    protected array $availableIncludes = [];

    protected array $defaultIncludes = [];

    public function transform(Permission $permission): array
    {
        return [
            'object' => $permission->getResourceKey(),
            'id' => $permission->getHashedKey(),
            'name' => $permission->name,
            'display_name' => $permission->display_name,
            'description' => $permission->description,
        ];
    }
}
