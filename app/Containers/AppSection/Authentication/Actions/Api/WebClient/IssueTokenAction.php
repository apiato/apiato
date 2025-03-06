<?php

namespace App\Containers\AppSection\Authentication\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Data\DTOs\Token;
use App\Containers\AppSection\Authentication\Tasks\IssueTokenTask;
use App\Containers\AppSection\Authentication\Values\ClientCredentials\WebClientCredential;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Ship\Parents\Actions\Action as ParentAction;

final class IssueTokenAction extends ParentAction
{
    public function __construct(
        private readonly IssueTokenTask $issueTokenTask,
    ) {
    }

    public function run(UserCredential $credential): Token
    {
        return $this->issueTokenTask->run(
            AccessTokenProxy::create(
                $credential,
                WebClientCredential::create(),
            ),
        );
    }
}
