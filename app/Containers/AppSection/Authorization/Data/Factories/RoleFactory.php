<?php

namespace App\Containers\AppSection\Authorization\Data\Factories;

use App\Containers\AppSection\Authorization\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
        ];
    }

    public function admin(): RoleFactory
    {
        return $this->state(function () {
            return [
                'name' => config('appSection-authorization.admin_role'),
            ];
        });
    }
}
