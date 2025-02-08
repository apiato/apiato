<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\DataTransferObjects\AuthResult;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class RefreshProxyForWebClientAction extends ParentAction
{
    public function __construct(
        private readonly CallOAuthServerTask $callOAuthServerTask,
        private readonly MakeRefreshTokenCookieTask $makeRefreshTokenCookieTask,
    ) {
    }

    /**
     * @throws LoginFailed
     */
    public function run(RefreshProxyRequest $request): AuthResult
    {
        $sanitizedData = $request->sanitize([
            'refresh_token' => $request->cookie('refreshToken'),
            'client_id' => config('appSection-authentication.clients.web.id'),
            'client_secret' => config('appSection-authentication.clients.web.secret'),
            'grant_type' => 'refresh_token',
            'scope' => '',
        ]);

        $responseContent = $this->callOAuthServerTask->run($sanitizedData, $request->headers->get('accept-language'));
        $refreshCookie = $this->makeRefreshTokenCookieTask->run($responseContent->refreshToken);

        return new AuthResult($responseContent, $refreshCookie);
    }
}
