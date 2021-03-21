<?php

namespace App\Containers\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class PermissionRepository extends Repository
{
    /**
     * the container name. Must be set when the model has different name than the container
     */
    protected string $container = 'Authorization';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];
}
