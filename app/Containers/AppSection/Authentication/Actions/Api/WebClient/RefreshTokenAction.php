<?php

namespace App\Containers\AppSection\Authentication\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Data\DTOs\Token;
use App\Containers\AppSection\Authentication\Tasks\IssueTokenTask;
use App\Containers\AppSection\Authentication\Values\ClientCredentials\WebClientCredential;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RefreshTokenAction extends ParentAction
{
    public function __construct(
        private readonly IssueTokenTask $issueTokenTask,
    ) {
    }

    public function run(RefreshToken $refreshToken): Token
    {
        return $this->issueTokenTask->run(
            RefreshTokenProxy::create(
                $refreshToken,
                WebClientCredential::create(),
            ),
        );
    }
}
