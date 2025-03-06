<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\Authentication\Data\DTOs\Token;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\PasswordGrantProxy;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

final class IssueTokenTask extends ParentTask
{
    public function run(PasswordGrantProxy $proxy): Token
    {
        $authFullApiUrl = route('passport.token');
        $headers = [
            'HTTP_ACCEPT' => 'application/json',
            'HTTP_ACCEPT_LANGUAGE' => request()->headers->get('accept-language', config('app.locale')),
        ];

        $request = Request::create($authFullApiUrl, 'POST', $proxy->toArray(), server: $headers);
        $response = App::handle($request);
        $content = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if (!$response->isOk()) {
            throw LoginFailed::create($content['message']);
        }

        return Token::fromArray($content);
    }
}
