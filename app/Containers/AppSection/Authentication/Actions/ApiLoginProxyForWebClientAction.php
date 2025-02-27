<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class ApiLoginProxyForWebClientAction extends ParentAction
{
    /**
     * @throws LoginFailed
     * @throws \Exception
     */
    public function run(UserCredential $credential): Token
    {
        return User::issueToken(AccessTokenProxy::create($credential, WebClient::create()));
    }
}
