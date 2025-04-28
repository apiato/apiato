<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Data\Factories;

use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Factories\Factory as ParentFactory;
use Illuminate\Support\Str;

/**
 * @template TModel of User
 *
 * @extends ParentFactory<TModel>
 */
class UserFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'password'          => 'password',
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
            'gender'            => fake()->randomElement(['male', 'female', 'unspecified']),
            'birth'             => fake()->date(),
        ];
    }

    public function admin(): self
    {
        return $this->afterCreating(function (User $user): void {
            $user->assignRole(config('appSection-authorization.admin_role'));
        });
    }

    public function unverified(): self
    {
        return $this->state(function (array $attributes): array {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function verified(): self
    {
        return $this->state(function (array $attributes): array {
            return [
                'email_verified_at' => now(),
            ];
        });
    }

    public function gender(Gender $gender): self
    {
        return $this->state(function (array $attributes) use ($gender): array {
            return ['gender' => $gender];
        });
    }
}
