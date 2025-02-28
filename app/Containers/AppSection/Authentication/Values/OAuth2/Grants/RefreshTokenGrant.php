<?php

namespace App\Containers\AppSection\Authentication\Values\OAuth2\Grants;

use App\Containers\AppSection\Authentication\Values\ClientCredentials\ClientCredential;
use App\Ship\Parents\Values\Value as ParentValue;

final readonly class RefreshTokenGrant extends ParentValue implements Grant
{
    private string $grantType;

    private function __construct(
        private ClientCredential $clientCredential,
        private string           $scope = '',
    ) {
        $this->grantType = 'refresh_token';
    }

    public static function create(ClientCredential $clientCredential, string $scope = ''): self
    {
        return new self($clientCredential, $scope);
    }

    public function toArray(): array
    {
        return [
            'grant_type' => $this->grantType,
            'scope' => $this->scope,
            'client_id' => $this->clientCredential->id(),
            'client_secret' => $this->clientCredential->secret(),
        ];
    }

    public function grantType(): string
    {
        return $this->grantType;
    }

    public function scope(): string
    {
        return $this->scope;
    }
}
