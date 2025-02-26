<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Data\Dto\AuthResult;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RefreshProxyForWebClientAction extends ParentAction
{
    public function __construct(
        private readonly MakeRefreshTokenCookieTask $makeRefreshTokenCookieTask,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function run(RefreshToken $refreshToken): AuthResult
    {
        $token = User::issueToken(RefreshTokenProxy::create($refreshToken, WebClient::create()));
        $refreshCookie = $this->makeRefreshTokenCookieTask->run($token->refreshToken);

        return new AuthResult($token, $refreshCookie);
    }
}
