<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Data\Transporters\ProxyRefreshTransporter;
use App\Containers\Authentication\Exceptions\RefreshTokenMissedException;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class ProxyRefreshForAdminWebClientAction extends Action
{
    public function run(ProxyRefreshTransporter $data): array
    {
        $requestData = [
            'grant_type' => $data->grant_type,
            'refresh_token' => $data->refresh_token ?: Request::cookie('refreshToken'),
            'client_id' => Config::get('authentication-container.clients.web.admin.id'),
            'client_secret' => Config::get('authentication-container.clients.web.admin.secret'),
            'scope' => $data->scope,
        ];

        if (!$requestData['refresh_token']) {
            throw new RefreshTokenMissedException();
        }

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
