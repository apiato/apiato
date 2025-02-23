<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Data\Dto\AuthResult;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class RefreshProxyForWebClientAction extends ParentAction
{
    public function __construct(
        private readonly CallOAuthServerTask $callOAuthServerTask,
        private readonly MakeRefreshTokenCookieTask $makeRefreshTokenCookieTask,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function run(array $data): AuthResult
    {
        $responseContent = $this->callOAuthServerTask->run($data);
        $refreshCookie = $this->makeRefreshTokenCookieTask->run($responseContent->refreshToken);

        return new AuthResult($responseContent, $refreshCookie);
    }
}
