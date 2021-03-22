<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\Authentication\UI\API\Requests\ProxyRefreshRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class ProxyRefreshForAdminWebClientAction extends Action
{
    public function run(ProxyRefreshRequest $data): array
    {
        $sanitizedData = $data->sanitizeInput([
            'refresh_token',
        ]);

        $sanitizedData['refresh_token'] = $sanitizedData['refresh_token'] ?: Request::cookie('refreshToken');
        $sanitizedData['client_id'] = Config::get('authentication-container.clients.web.admin.id');
        $sanitizedData['client_secret'] = Config::get('authentication-container.clients.web.admin.secret');
        $sanitizedData['grant_type'] = 'refresh_token';
        $sanitizedData['scope'] = '';

        if (!$sanitizedData['refresh_token']) {
            throw new RefreshTokenMissedException();
        }

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$sanitizedData]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}