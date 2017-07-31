<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\Authentication\Tasks\CheckIfUserIsConfirmedTask;
use App\Containers\Authentication\Tasks\MakeRefreshCookieTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class ProxyApiLoginAction.
 */
class ProxyApiLoginAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     * @param                                    $clientId
     * @param                                    $clientPassword
     *
     * @return  array
     */
    public function run(Request $request, $clientId, $clientPassword)
    {
        $requestData = [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '',
        ];

        $responseContent = $this->call(CallOAuthServerTask::class, [$requestData]);

        // lets check, if only confirmed users shall be authenticated
        // we do this here, because this assures, that the user that tries to login is, in fact, valid
        // this, furthermore, assures that an attacker cannot "guess" unconfirmed e-mail addresses!
        $this->call(CheckIfUserIsConfirmedTask::class, [], [ ['loginWithCredentials' => [$requestData['username'], $requestData['password']]]]);

        $refreshCookie = $this->call(MakeRefreshCookieTask::class, [$responseContent['refresh_token']]);

        // Make sure we only send the refresh_token in the cookie
        unset($responseContent['refresh_token']);

        return [
            'response-content' => $responseContent,
            'refresh-cookie'   => $refreshCookie,
        ];
    }
}
