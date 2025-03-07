<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;
use Webmozart\Assert\Assert;

final readonly class RefreshToken extends ParentValue
{
    private function __construct(
        private string $refreshToken,
    ) {
    }

    public static function create(string $refreshToken): self
    {
        Assert::stringNotEmpty($refreshToken);

        return new self($refreshToken);
    }

    public function value(): string
    {
        return $this->refreshToken;
    }
}
