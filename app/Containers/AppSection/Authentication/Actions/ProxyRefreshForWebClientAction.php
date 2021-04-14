<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyRefreshRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Request;

class ProxyRefreshForWebClientAction extends Action
{
    public function run(ProxyRefreshRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput([
            'refresh_token',
        ]);

        $sanitizedData['refresh_token'] = $sanitizedData['refresh_token'] ?: Request::cookie('refreshToken');
        $sanitizedData['client_id'] = config('appSection-authentication.clients.web.id');
        $sanitizedData['client_secret'] = config('appSection-authentication.clients.web.secret');
        $sanitizedData['grant_type'] = 'refresh_token';
        $sanitizedData['scope'] = '';

        if (!$sanitizedData['refresh_token']) {
            throw new RefreshTokenMissedException();
        }

        $responseContent = app(CallOAuthServerTask::class)->run($sanitizedData, $request->headers->get('accept-language'));
        $refreshCookie = app(MakeRefreshCookieTask::class)->run($responseContent['refresh_token']);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
