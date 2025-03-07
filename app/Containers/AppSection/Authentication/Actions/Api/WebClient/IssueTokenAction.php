<?php

namespace App\Containers\AppSection\Authentication\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordAccessTokenResponse;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenRequestProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Ship\Parents\Actions\Action as ParentAction;

final class IssueTokenAction extends ParentAction
{
    public function __construct(
        private readonly PasswordTokenFactory $passwordTokenFactory,
    ) {
    }

    public function run(UserCredential $credential): PasswordAccessTokenResponse
    {
        return $this->passwordTokenFactory->make(
            AccessTokenRequestProxy::create(
                $credential,
                WebClient::create(),
            ),
        )->response();
    }
}
