<?php

namespace App\Containers\Authorization\Data\Repositories;

use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Repositories\Repository;

class PermissionRepository extends Repository
{
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];

    public function model(): string
    {
        return Permission::class;
    }
}
