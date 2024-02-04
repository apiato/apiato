<?php

namespace App\Containers\AppSection\Authorization\Data\Factories;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Factories\Factory as ParentFactory;

/**
 * @template TModel of Role
 *
 * @extends ParentFactory<TModel>
 */
class RoleFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->firstName(),
            'guard_name' => 'api',
        ];
    }

    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => config('appSection-authorization.admin_role'),
            ];
        });
    }

    public function withGuard(string $guard): static
    {
        return $this->state(function (array $attributes) use ($guard) {
            return [
                'guard_name' => $guard,
            ];
        });
    }
}
