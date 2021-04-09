<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyRefreshRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class ProxyRefreshForWebClientAction extends Action
{
    public function run(ProxyRefreshRequest $data): array
    {
        $sanitizedData = $data->sanitizeInput([
            'refresh_token',
        ]);

        $sanitizedData['refresh_token'] = $sanitizedData['refresh_token'] ?: Request::cookie('refreshToken');
        $sanitizedData['client_id'] = Config::get('authentication-container.clients.web.id');
        $sanitizedData['client_secret'] = Config::get('authentication-container.clients.web.secret');
        $sanitizedData['grant_type'] = 'refresh_token';
        $sanitizedData['scope'] = '';

        if (!$sanitizedData['refresh_token']) {
            throw new RefreshTokenMissedException();
        }

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$sanitizedData, $data->headers->get('accept-language')]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
