<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

class Token extends ParentValue
{
    public function __construct(
        public readonly string $tokenType,
        public readonly int $expiresIn,
        public readonly string $accessToken,
        public readonly string $refreshToken,
    ) {
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
