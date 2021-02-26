<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Data\Transporters\LoginTransporter;
use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Ship\Parents\Actions\Action;

class ApiLoginProxyAction extends Action
{
    public function run(ProxyApiLoginTransporter $data): array
    {
        Apiato::call('Authentication@LoginSubAction', [new LoginTransporter($data->getArrayCopy())]);
        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$data]);

        $requestData = [
            'username' => $loginCustomAttribute['username'],
            'password' => $data->password,
            'grant_type' => $data->grant_type ?? 'password',
            'client_id' => $data->client_id,
            'client_secret' => $data->client_password,
            'scope' => $data->scope ?? '',
        ];

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
