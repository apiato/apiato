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

        $requestData = [
            'username' => $loginCustomAttribute['username'],
            'password' => $data->password,
            'grant_type' => $data->grant_type,
            'client_id' => Config::get('authentication-container.clients.web.admin.id'),
            'client_secret' => Config::get('authentication-container.clients.web.admin.secret'),
            'scope' => $data->scope,
        ];

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
