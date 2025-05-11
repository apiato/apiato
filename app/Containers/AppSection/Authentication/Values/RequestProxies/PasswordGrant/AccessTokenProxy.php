<?php

namespace App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant;

use App\Containers\AppSection\Authentication\Values\Clients\Client;
use App\Containers\AppSection\Authentication\Values\ScopeCollection;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Ship\Parents\Values\Value as ParentValue;

final readonly class AccessTokenProxy extends ParentValue
{
    private function __construct(
        private UserCredential $credential,
        private Client $client,
        private ScopeCollection $scope,
    ) {
    }

    public static function create(UserCredential $userCredential, Client $client, string $scope = ''): self
    {
        return new self($userCredential, $client, ScopeCollection::from($scope));
    }

    public function toArray(): array
    {
        return [
            'grant_type' => 'password',
            'username' => $this->credential->username(),
            'password' => $this->credential->password(),
            'client_id' => $this->client->id(),
            'client_secret' => $this->client->plainSecret(),
            'scope' => $this->scope->toString(),
        ];
    }
}
