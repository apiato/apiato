<?php

namespace App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant;

use App\Containers\AppSection\Authentication\Values\Clients\Client;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\Authentication\Values\ScopeCollection;
use App\Ship\Parents\Values\Value as ParentValue;

final readonly class RefreshTokenProxy extends ParentValue
{
    private function __construct(
        private RefreshToken $refreshToken,
        private Client $client,
        private ScopeCollection $scope,
    ) {
    }

    public static function create(RefreshToken $refreshToken, Client $client, string $scope = ''): self
    {
        return new self($refreshToken, $client, ScopeCollection::from($scope));
    }

    public function toArray(): array
    {
        return [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refreshToken->value(),
            'client_id' => $this->client->id(),
            'client_secret' => $this->client->plainSecret(),
            'scope' => $this->scope->toString(),
        ];
    }
}
