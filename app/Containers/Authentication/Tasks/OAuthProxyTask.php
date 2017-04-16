<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class OAuthProxyTask.
 */
class OAuthProxyTask extends Task
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

        // load the corresponding credentials of my trusted client.
        switch ($client) {
            case 'AdminWeb':
                $clientId = env('CLIENT_WEB_ADMIN_ID');
                $clientSecret = env('CLIENT_WEB_ADMIN_SECRET');
                break;
            case 'ClientWeb':
                // ...
                $clientId = null;
                $clientSecret = null;
                break;
            case 'ClientMobile':
                // ...
                $clientId = null;
                $clientSecret = null;
                break;
        }

        $parameters = array_merge($data, [
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ]);

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
        $refreshCookie = cookie(
            'refreshToken',
            $content['refresh_token'],
            Config::get('apiato.api.refresh-expires-in'),
            null,
            null,
            false,
            true // HttpOnly
        );

        // Make sure we only send the refresh_token in the cookie
        unset($content['refresh_token']);

        return [
            'content'       => $content,
            'refreshCookie' => $refreshCookie,
        ];
    }
}
