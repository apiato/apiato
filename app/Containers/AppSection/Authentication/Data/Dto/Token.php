<?php

namespace App\Containers\AppSection\Authentication\Data\Dto;

use Apiato\Http\Resources\HasResourceKey;
use Apiato\Http\Resources\ResourceKeyAware;

// TODO
final readonly class Token implements ResourceKeyAware
{
    use HasResourceKey;

    public function __construct(
        public string $tokenType,
        public int $expiresIn,
        public string $accessToken,
        public string $refreshToken,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['token_type'],
            $data['expires_in'],
            $data['access_token'],
            $data['refresh_token'],
        );
    }

    public static function fake(): self
    {
        return new self(
            fake()->word(),
            fake()->numberBetween(),
            fake()->sha256(),
            fake()->sha256(),
        );
    }
}
