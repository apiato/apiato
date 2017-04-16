<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\Authentication\Tasks\MakeRefreshCookieTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ProxyApiLoginAction.
 */
class ProxyApiLoginAction extends Action
{

    /**
     * @param $clientId
     * @param $clientPassword
     * @param $email
     * @param $password
     *
     * @return  mixed
     */
    public function run($clientId, $clientPassword, $email, $password)
    {
        $requestData = [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'username'      => $email,
            'password'      => $password,
            'scope'         => '',
        ];

        $responseContent = $this->call(CallOAuthServerTask::class, [$requestData]);

        $refreshCookie = $this->call(MakeRefreshCookieTask::class, [$responseContent['refresh_token']]);

        // Make sure we only send the refresh_token in the cookie
        unset($responseContent['refresh_token']);

        return [
            'response-content' => $responseContent,
            'refresh-cookie'   => $refreshCookie,
        ];
    }
}
