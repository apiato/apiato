<?php

namespace App\Containers\AppSection\Authentication\Data\Factories;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordAccessTokenResponse;

final readonly class AccessTokenResponseFactory
{
    public static function create(array $data = []): PasswordAccessTokenResponse
    {
        return new PasswordAccessTokenResponse(
            $data['token_type'] ?? fake()->word(),
            $data['expires_in'] ?? fake()->numberBetween(),
            $data['access_token'] ?? fake()->sha256(),
            $data['refresh_token'] ?? fake()->sha256(),
        );
    }
}
