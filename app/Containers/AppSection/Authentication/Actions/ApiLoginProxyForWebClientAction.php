<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Ship\Parents\Actions\Action;

class ApiLoginProxyForWebClientAction extends Action
{
    /**
     * @throws LoginFailedException
     */
    public function run(LoginProxyPasswordGrantRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput(
            [
                ...array_keys(config('appSection-authentication.login.attributes')),
                ...['password'],
            ]
        );

        $loginCustomAttribute = app(ExtractLoginCustomAttributeTask::class)->run($sanitizedData);
        $sanitizedData = $this->enrichSanitizedData($loginCustomAttribute['username'], $sanitizedData);

        $responseContent = app(CallOAuthServerTask::class)->run($sanitizedData, $request->headers->get('accept-language'));
        $refreshCookie = app(MakeRefreshCookieTask::class)->run($responseContent['refresh_token']);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }

    private function enrichSanitizedData($username, array $sanitizedData): array
    {
        $sanitizedData['username'] = $username;
        $sanitizedData['client_id'] = config('appSection-authentication.clients.web.id');
        $sanitizedData['client_secret'] = config('appSection-authentication.clients.web.secret');
        $sanitizedData['grant_type'] = 'password';
        $sanitizedData['scope'] = '';
        return $sanitizedData;
    }
}
