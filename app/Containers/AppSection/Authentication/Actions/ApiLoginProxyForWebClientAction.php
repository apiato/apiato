<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Data\Dto\AuthResult;
use App\Containers\AppSection\Authentication\Data\Dto\WebClient\PasswordGrantLoginProxy;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class ApiLoginProxyForWebClientAction extends ParentAction
{
    public function __construct(
        private readonly CallOAuthServerTask $callOAuthServerTask,
        private readonly MakeRefreshTokenCookieTask $makeRefreshTokenCookieTask,
    ) {
    }

    /**
     * @throws LoginFailed
     * @throws \Exception
     */
    public function run(PasswordGrantLoginProxy $data): AuthResult
    {
        $token = $this->callOAuthServerTask->run($data);
        $refreshTokenCookie = $this->makeRefreshTokenCookieTask->run($token->refreshToken);

        return new AuthResult($token, $refreshTokenCookie);
    }
}
