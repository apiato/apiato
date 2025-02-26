<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

final readonly class RefreshToken extends ParentValue
{
    public function __construct(
        private string $refreshToken,
    ) {
    }

    public static function create(string $refreshToken): self
    {
        return new self($refreshToken);
    }

    public function toArray(): array
    {
        return [
            'refresh_token' => $this->refreshToken,
        ];
    }

    public function value(): string
    {
        return $this->refreshToken;
    }
}
