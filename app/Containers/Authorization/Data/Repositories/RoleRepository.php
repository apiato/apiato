<?php

namespace App\Containers\Authorization\Data\Repositories;

use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Repositories\Repository;

class RoleRepository extends Repository
{
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];

    public function model(): string
    {
        return Role::class;
    }
}
