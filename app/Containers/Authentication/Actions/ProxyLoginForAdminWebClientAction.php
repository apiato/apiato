<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Data\Transporters\ProxyLoginPasswordGrantTransporter;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;

class ProxyLoginForAdminWebClientAction extends Action
{
    public function run(ProxyLoginPasswordGrantTransporter $data): array
    {
        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$data]);

        $data->set('username', $loginCustomAttribute['username']);
        $data->set('client_id', Config::get('authentication-container.clients.web.admin.id'));
        $data->set('client_secret', Config::get('authentication-container.clients.web.admin.secret'));

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$data->toArray()]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
