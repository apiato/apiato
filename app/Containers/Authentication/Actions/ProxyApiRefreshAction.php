<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class ProxyApiRefreshAction.
 */
class ProxyApiRefreshAction extends Action
{

    /**
     * @param string      $clientId
     * @param string      $clientPassword
     * @param string      $refreshToken
     * @param string|null $cookie
     *
     * @return  array
     */
    public function run(string $clientId, string $clientPassword, string $refreshToken, string $cookie = null): array
    {
        // use the refresh token sent in request data, if not exist try to get it from the cookie
        $refreshToken = $refreshToken ?? $cookie;

        $requestData = [
            'grant_type'    => 'refresh_token',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'refresh_token' => $refreshToken,
            'scope'         => '',
        ];

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);

        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response-content' => $responseContent,
            'refresh-cookie'   => $refreshCookie,
        ];
    }
}
