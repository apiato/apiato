<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Ship\Parents\Tasks\Task;
use GuzzleHttp\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class CallOAuthServerTask extends Task
{
    private const AUTH_ROUTE = '/v1/oauth/token';

    public function run(array $data): array
    {
        $authFullApiUrl = Config::get('apiato.api.url') . self::AUTH_ROUTE;

        $headers = ['HTTP_ACCEPT' => 'application/json'];

        $request = Request::create($authFullApiUrl, 'POST', $data, [], [], $headers);

        $response = App::handle($request);

        $content = Utils::jsonDecode($response->getContent(), true);

        // If the internal request to the oauth token endpoint was not successful we throw an exception
        if (!$response->isSuccessful()) {
            throw new LoginFailedException($content['message'], null, $response->getStatusCode());
        }

        return $content;
    }
}
