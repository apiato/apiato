<?php

namespace App\Containers\AppSection\Authentication\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Values\ClientCredentials\WebClientCredential;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class IssueTokenAction extends ParentAction
{
    public function run(UserCredential $credential): Token
    {
        return User::issueToken(AccessTokenProxy::create($credential, WebClientCredential::create()));
    }
}
