<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class CallOAuthServerTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CallOAuthServerTask extends Task
{

    /**
     * @string
     */
    CONST AUTH_ROUTE = '/v1/oauth/token';

    /**
     * @param $data
     *
     * @return  array
     * @throws \App\Containers\Authentication\Exceptions\LoginFailedException
     */
    public function run($data)
    {
        // Full url to the oauth token endpoint
        $authFullApiUrl = Config::get('apiato.api.url') . self::AUTH_ROUTE;

        $headers = ['HTTP_ACCEPT' => 'application/json'];

        // Create and handle the oauth request
        $request = Request::create($authFullApiUrl, 'POST', $data, [], [], $headers);

        $response = App::handle($request);

        // response content as Array
        $content = \GuzzleHttp\json_decode($response->getContent(), true);

        // If the internal request to the oauth token endpoint was not successful we throw an exception
        if (!$response->isSuccessful()) {
            throw new LoginFailedException($content['message'] . '. (OAuth 2.0 is not installed).', null, $response->getStatusCode());
        }

        return $content;
    }
}
