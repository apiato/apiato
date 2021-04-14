<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTask;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Parser;

class ProxyLoginForWebClientAction extends Action
{
    public function run(ProxyLoginPasswordGrantRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput(
            array_merge(
                array_keys(config('appSection-authentication.login.attributes')),
                ['password']
            )
        );

        $loginCustomAttribute = app(ExtractLoginCustomAttributeTask::class)->run($sanitizedData);

        $sanitizedData['username'] = $loginCustomAttribute['username'];
        $sanitizedData['client_id'] = config('appSection-authentication.clients.web.id');
        $sanitizedData['client_secret'] = config('appSection-authentication.clients.web.secret');
        $sanitizedData['grant_type'] = 'password';
        $sanitizedData['scope'] = '';

        $responseContent = app(CallOAuthServerTask::class)->run($sanitizedData, $request->headers->get('accept-language'));
        $this->processEmailConfirmationIfNeeded($responseContent);
        $refreshCookie = app(MakeRefreshCookieTask::class)->run($responseContent['refresh_token']);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }

    private function processEmailConfirmationIfNeeded($response): void
    {
        $user = $this->extractUserFromAuthServerResponse($response);
        $isUserConfirmed = app(CheckIfUserEmailIsConfirmedTask::class)->run($user);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }
    }

    private function extractUserFromAuthServerResponse($response)
    {
        $tokenId = app(Parser::class)->parse($response['access_token'])->claims()->get('jti');
        $userAccessRecord = DB::table('oauth_access_tokens')->find($tokenId);
        return User::find($userAccessRecord->user_id);
    }
}
