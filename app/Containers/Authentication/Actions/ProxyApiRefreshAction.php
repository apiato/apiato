<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\Authentication\Tasks\MakeRefreshCookieTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ProxyApiRefreshAction.
 */
class ProxyApiRefreshAction extends Action
{

    /**
     * @param $clientId
     * @param $clientPassword
     * @param $refresh_token
     *
     * @return  mixed
     */
    public function run($clientId, $clientPassword, $refresh_token)
    {
        $requestData = [
            'grant_type'    => 'refresh_token',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'refresh_token' => $refresh_token,
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
