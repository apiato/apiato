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
        $data->set('refresh_token', $data->refresh_token ?: Request::cookie('refreshToken'));
        $data->set('client_id', Config::get('authentication-container.clients.web.admin.id'));
        $data->set('client_secret', Config::get('authentication-container.clients.web.admin.secret'));

        if (!$data->refresh_token) {
            throw new RefreshTokenMissedException();
        }

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$data->toArray()]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
