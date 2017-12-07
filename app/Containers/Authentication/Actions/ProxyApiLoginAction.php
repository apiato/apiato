<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class ProxyApiLoginAction.
 */
class ProxyApiLoginAction extends Action
{

    /**
     * @param string $clientId
     * @param string $clientPassword
     * @param string $email
     * @param string $password
     *
     * @return  array
     */
    public function run(string $clientId, string $clientPassword, string $email, string $password): array
    {
        $requestData = [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'username'      => $email,
            'password'      => $password,
            'scope'         => '',
        ];

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);

        // check if user email is confirmed only if that feature is enabled.
        Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [],
            [['loginWithCredentials' => [$requestData['username'], $requestData['password']]]]);

        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response-content' => $responseContent,
            'refresh-cookie'   => $refreshCookie,
        ];
    }
}
