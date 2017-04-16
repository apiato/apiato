<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Authentication\Tasks\GetRefreshCookieTask;
use App\Containers\Authentication\Tasks\InjectClientIdAndSecretTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class OAuthProxyTask.
 */
class OAuthProxyTask extends Action
{
    /**
     * @string
     */
    CONST AUTH_ROUTE = '/v1/oauth/token';

    /**
     * @param $data
     * @param $client
     *
     * @return mixed
     * @throws \App\Containers\Authentication\Exceptions\LoginFailedException
     * @internal param $refresh_token
     */
    public function run($data, $client)
    {
        // Full url to the oauth token endpoint
        $authFullApiUrl = Config::get('apiato.api.url') . self::AUTH_ROUTE;

        // Inject the corresponding client_id and client_secret to the data array
        $parameters = $this->call(InjectClientIdAndSecretTask::class, [$client, $data]);

        // Create and handle the oauth request
        $request = Request::create($authFullApiUrl, 'POST', $parameters);
        $response = App::handle($request);

        // response content as Array
        $content = \GuzzleHttp\json_decode($response->getContent(), true);

        // If the internal request to the oauth token endpoint was not successful we throw an exception
        if (!$response->isSuccessful()) {
            throw new LoginFailedException($content['message'] . ' (' . $content['error'] . ')', null, $response->getStatusCode());
        }

        // Save the refresh token in a HttpOnly cookie to minimize the risk of XSS attacks
        $refreshCookie = $this->call(GetRefreshCookieTask::class, [$content['refresh_token']]);

        // Make sure we only send the refresh_token in the cookie
        unset($content['refresh_token']);

        return [
            'content'       => $content,
            'refreshCookie' => $refreshCookie,
        ];
    }
}
