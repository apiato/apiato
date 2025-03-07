<?php

namespace App\Containers\AppSection\Authentication\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordAccessTokenResponse;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Values\Clients\WebPasswordClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\RefreshTokenRequestProxy;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RefreshTokenAction extends ParentAction
{
    public function __construct(
        private readonly PasswordTokenFactory $passwordTokenFactory,
    ) {
    }

    public function run(RefreshToken $refreshToken): PasswordAccessTokenResponse
    {
        return $this->passwordTokenFactory->make(
            RefreshTokenRequestProxy::create(
                $refreshToken,
                WebPasswordClient::create(),
            ),
        )->response();
    }
}
