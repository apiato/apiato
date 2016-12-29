<?php

namespace App\Containers\Authorization\UI\API\Transformers;

use App\Containers\Authorization\Models\Role;
use App\Port\Transformer\Abstracts\Transformer;

/**
 * Class RoleTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoleTransformer extends Transformer
{

    protected $availableIncludes = [

    ];

    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\Authorization\Models\Role $role
     *
     * @return array
     */
    public function transform(Role $role)
    {
        return [
            'name' => $role->display_name,
            'description'  => $role->description,
        ];
    }

}
