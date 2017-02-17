<?php

namespace App\Containers\Authorization\UI\API\Transformers;

use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class PermissionTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PermissionTransformer extends Transformer
{

    protected $availableIncludes = [

    ];

    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\Authorization\Models\Permission $permission
     *
     * @return array
     */
    public function transform(Permission $permission)
    {
        return [
            'object'       => 'Permission',
            'id'           => $permission->getHashedKey(), // << Unique Identifier
            'name'         => $permission->name, // << Unique Identifier
            'description'  => $permission->description,
            'display_name' => $permission->display_name,
        ];
    }

}
