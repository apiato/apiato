<?php

namespace App\Containers\Authorization\Data\Factories;

use App\Containers\Authorization\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->slug,
        ];
    }
}
