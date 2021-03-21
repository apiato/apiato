<?php

namespace App\Containers\Authorization\UI\API\Transformers;

use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Transformers\Transformer;

class PermissionTransformer extends Transformer
{
    protected $availableIncludes = [

    ];

    protected $defaultIncludes = [

    ];

    public function transform(Permission $permission): array
    {
        return [
            'object' => 'Permission',
            'id' => $permission->getHashedKey(), // << Unique Identifier
            'name' => $permission->name, // << Unique Identifier
            'description' => $permission->description,
            'display_name' => $permission->display_name,
        ];
    }
}
