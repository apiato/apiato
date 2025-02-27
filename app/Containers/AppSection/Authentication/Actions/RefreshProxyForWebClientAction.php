<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RefreshProxyForWebClientAction extends ParentAction
{
    /**
     * @throws \Exception
     */
    public function run(RefreshToken $refreshToken): Token
    {
        return User::issueToken(RefreshTokenProxy::create($refreshToken, WebClient::create()));
    }
}
