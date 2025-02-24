<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Data\Dto\WebClient\PasswordGrantLoginProxy;
use App\Containers\AppSection\Authentication\Data\Dto\WebClient\RefreshProxy;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Ship\Parents\Tasks\Task as ParentTask;
use GuzzleHttp\Utils;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

final class CallOAuthServerTask extends ParentTask
{
    /**
     * @throws \Exception
     */
    public function run(PasswordGrantLoginProxy|RefreshProxy $data): Token
    {
        $authFullApiUrl = route('passport.token');
        $headers = [
            'HTTP_ACCEPT' => 'application/json',
            'HTTP_ACCEPT_LANGUAGE' => request()->headers->get('accept-language', config('app.locale')),
        ];

        $request = Request::create($authFullApiUrl, 'POST', $data->toArray(), server: $headers);
        $response = App::handle($request);
        $content = Utils::jsonDecode($response->getContent(), true);

        if (!$response->isOk()) {
            throw LoginFailed::create();
        }

        return new Token($content['token_type'], $content['expires_in'], $content['access_token'], $content['refresh_token']);
    }
}
