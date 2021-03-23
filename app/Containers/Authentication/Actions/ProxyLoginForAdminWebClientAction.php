<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;

class ProxyLoginForAdminWebClientAction extends Action
{
    public function run(ProxyLoginPasswordGrantRequest $data): array
    {
        $sanitizedData = $data->sanitizeInput(
            array_merge(
                array_keys(Config::get('authentication-container.login.attributes')),
                ['password']
            )
        );

        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$sanitizedData]);

        $sanitizedData['username'] = $loginCustomAttribute['username'];
        $sanitizedData['client_id'] = Config::get('authentication-container.clients.web.admin.id');
        $sanitizedData['client_secret'] = Config::get('authentication-container.clients.web.admin.secret');
        $sanitizedData['grant_type'] = 'password';
        $sanitizedData['scope'] = '';

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$sanitizedData]);
        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
