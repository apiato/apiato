<?php

namespace App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant;

use App\Containers\AppSection\Authentication\Values\Clients\Client;
use App\Containers\AppSection\Authentication\Values\OAuth2\Grants\PasswordGrant;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Ship\Parents\Values\Value as ParentValue;

final readonly class AccessTokenProxy extends ParentValue implements PasswordGrantProxy
{
    private function __construct(
        private UserCredential $credential,
        private PasswordGrant $grant,
    ) {
    }

    public static function create(UserCredential $credential, Client $client): self
    {
        return new self(
            $credential,
            PasswordGrant::create($client),
        );
    }

    public function toArray(): array
    {
        return [
            ...$this->credential->toArray(),
            ...$this->grant->toArray(),
        ];
    }

    public function credentials(): UserCredential
    {
        return $this->credential;
    }

    public function grant(): PasswordGrant
    {
        return $this->grant;
    }
}
