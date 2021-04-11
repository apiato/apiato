<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTask;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Parser;

class ProxyLoginForWebClientAction extends Action
{
    public function run(ProxyLoginPasswordGrantRequest $data): array
    {
        $sanitizedData = $data->sanitizeInput(
            array_merge(
                array_keys(Config::get('authentication-container.login.attributes')),
                ['password']
            )
        );

        $loginCustomAttribute = Apiato::call(ExtractLoginCustomAttributeTask::class, [$sanitizedData]);

        $sanitizedData['username'] = $loginCustomAttribute['username'];
        $sanitizedData['client_id'] = Config::get('authentication-container.clients.web.id');
        $sanitizedData['client_secret'] = Config::get('authentication-container.clients.web.secret');
        $sanitizedData['grant_type'] = 'password';
        $sanitizedData['scope'] = '';

        $responseContent = Apiato::call(CallOAuthServerTask::class, [$sanitizedData, $data->headers->get('accept-language')]);
        $this->processEmailConfirmationIfNeeded($responseContent);
        $refreshCookie = Apiato::call(MakeRefreshCookieTask::class, [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }

    private function processEmailConfirmationIfNeeded($response): void
    {
        $user = $this->extractUserFromAuthServerResponse($response);
        $isUserConfirmed = Apiato::call(CheckIfUserEmailIsConfirmedTask::class, [$user]);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }
    }

    private function extractUserFromAuthServerResponse($response)
    {
        $tokenId = App::make(Parser::class)->parse($response['access_token'])->claims()->get('jti');
        $userAccessRecord = DB::table('oauth_access_tokens')->find($tokenId);
        return User::find($userAccessRecord->user_id);
    }
}
