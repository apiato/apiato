<?php

namespace App\Containers\AppSection\Authentication\Data\DTOs;

use Apiato\Http\Resources\HasResourceKey;
use Apiato\Http\Resources\ResourceKeyAware;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use Webmozart\Assert\Assert;

final readonly class PasswordToken implements ResourceKeyAware
{
    use HasResourceKey;

    public function __construct(
        public string $tokenType,
        public int $expiresIn,
        public string $accessToken,
        public RefreshToken $refreshToken,
    ) {
        Assert::stringNotEmpty($this->tokenType);
        Assert::same($this->tokenType, 'Bearer');
        Assert::greaterThan($this->expiresIn, 0);
        Assert::stringNotEmpty($this->accessToken);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['token_type'],
            $data['expires_in'],
            $data['access_token'],
            RefreshToken::create($data['refresh_token']),
        );
    }
}
