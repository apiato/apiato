<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Data\Dto\AuthResult;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class ApiLoginProxyForWebClientAction extends ParentAction
{
    public function __construct(
        private readonly MakeRefreshTokenCookieTask $makeRefreshTokenCookieTask,
    ) {
    }

    /**
     * @throws LoginFailed
     * @throws \Exception
     */
    public function run(UserCredential $credential): AuthResult
    {
        $token = User::issueToken(AccessTokenProxy::create($credential, WebClient::create()));
        $refreshTokenCookie = $this->makeRefreshTokenCookieTask->run($token->refreshToken);

        return new AuthResult($token, $refreshTokenCookie);
    }
}
