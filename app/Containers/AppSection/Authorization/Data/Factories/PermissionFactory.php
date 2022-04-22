<?php

namespace App\Containers\AppSection\Authorization\Data\Factories;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class PermissionFactory extends ParentFactory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'guard_name' => 'api',
        ];
    }
}
