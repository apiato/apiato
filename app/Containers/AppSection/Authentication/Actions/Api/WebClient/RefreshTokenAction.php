<?php

namespace App\Containers\AppSection\Authentication\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Values\ClientCredentials\WebClientCredential;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RefreshTokenAction extends ParentAction
{
    public function run(RefreshToken $refreshToken): Token
    {
        return User::issueToken(RefreshTokenProxy::create($refreshToken, WebClientCredential::create()));
    }
}
