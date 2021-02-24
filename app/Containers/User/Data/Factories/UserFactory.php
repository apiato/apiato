<?php

namespace App\Containers\User\Data\Factories;

use App\Containers\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        static $password;

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password ?: $password = Hash::make('testing-password'),
            'remember_token' => Str::random(10),
            'is_client' => false,
        ];
    }

    public function client(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_client' => true,
            ];
        });
    }
}
