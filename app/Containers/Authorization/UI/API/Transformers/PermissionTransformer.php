<?php

namespace App\Containers\Authorization\UI\API\Transformers;

use App\Containers\Authorization\Models\Permission;
use App\Port\Transformer\Abstracts\Transformer;

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
            'name'         => $permission->name,
            'description'  => $permission->description,
            'display_name' => $permission->display_name,
        ];
    }

}
