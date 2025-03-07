<?php

namespace App\Containers\AppSection\Authentication\Data\Factories;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;

final readonly class PasswordTokenFactory
{
    public static function create(array $data = []): PasswordToken
    {
        return new PasswordToken(
            $data['token_type'] ?? fake()->word(),
            $data['expires_in'] ?? fake()->numberBetween(),
            $data['access_token'] ?? fake()->sha256(),
            $data['refresh_token'] ?? fake()->sha256(),
        );
    }
}
