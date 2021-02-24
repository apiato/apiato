<?php

namespace App\Containers\Authorization\Data\Factories;

use App\Containers\Authorization\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->slug,
        ];
    }
}
