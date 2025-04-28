<?php

declare(strict_types=1);

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
            'name'       => fake()->unique()->firstName(),
            'guard_name' => 'api',
        ];
    }

    public function admin(): self
    {
        return $this->state(function (array $attributes): array {
            return [
                'name' => config('appSection-authorization.admin_role'),
            ];
        });
    }

    public function withGuard(string $guard): self
    {
        return $this->state(function (array $attributes) use ($guard): array {
            return [
                'guard_name' => $guard,
            ];
        });
    }
}
