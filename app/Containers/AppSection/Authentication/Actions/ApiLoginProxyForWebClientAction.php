<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Containers\AppSection\Authentication\Values\AuthResult;
use App\Ship\Parents\Actions\Action as ParentAction;

class ApiLoginProxyForWebClientAction extends ParentAction
{
    public function __construct(
        private readonly CallOAuthServerTask $callOAuthServerTask,
        private readonly MakeRefreshCookieTask $makeRefreshCookieTask,
    ) {
    }

    /**
     * @throws LoginFailedException
     * @throws IncorrectIdException
     */
    public function run(LoginProxyPasswordGrantRequest $request): AuthResult
    {
        $sanitizedData = $request->sanitizeInput([
            ...array_keys(config('appSection-authentication.login.fields')),
            'password',
            'client_id' => config('appSection-authentication.clients.web.id'),
            'client_secret' => config('appSection-authentication.clients.web.secret'),
            'grant_type' => 'password',
            'scope' => '',
        ]);

        [$loginFieldValue] = LoginFieldProcessor::extract($sanitizedData);
        $sanitizedData['username'] = $loginFieldValue;

        $responseContent = $this->callOAuthServerTask->run($sanitizedData, $request->headers->get('accept-language'));
        $refreshCookie = $this->makeRefreshCookieTask->run($responseContent->refreshToken);

        return new AuthResult($responseContent, $refreshCookie);
    }
}
