<?php

namespace App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant;

use App\Containers\AppSection\Authentication\Values\Clients\Client;
use App\Containers\AppSection\Authentication\Values\OAuth2\Grants\RefreshTokenGrant;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Ship\Parents\Values\Value as ParentValue;

final readonly class RefreshTokenProxy extends ParentValue implements PasswordGrantProxy
{
    private function __construct(
        private RefreshToken $refreshToken,
        private RefreshTokenGrant $grant,
    ) {
    }

    public static function create(RefreshToken $refreshToken, Client $client): self
    {
        return new self(
            $refreshToken,
            RefreshTokenGrant::create($client),
        );
    }

    public function toArray(): array
    {
        return [
            ...$this->refreshToken->toArray(),
            ...$this->grant->toArray(),
        ];
    }

    public function refreshToken(): RefreshToken
    {
        return $this->refreshToken;
    }

    public function grant(): RefreshTokenGrant
    {
        return $this->grant;
    }
}
