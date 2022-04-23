<?php

namespace App\Containers\AppSection\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class PermissionRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];

    public function model(): string
    {
        return config('permission.models.permission');
    }
}
