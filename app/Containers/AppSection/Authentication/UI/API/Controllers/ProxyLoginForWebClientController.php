<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ProxyLoginForWebClientAction;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ProxyLoginForWebClientController extends ApiController
{
    /**
     * This `proxyLoginForWebClient` exist only because we have `WebClient`
     * The more clients (Web Apps). Each client you add in the future, must have
     * similar functions here, with custom route for dedicated for each client
     * to be used as proxy when contacting the OAuth server.
     * This is only to help the Web Apps (JavaScript clients) hide
     * their ID's and Secrets when contacting the OAuth server and obtain Tokens.
     *
     * @throws LoginFailedException
     * @throws UserNotConfirmedException
     */
    public function proxyLoginForWebClient(ProxyLoginPasswordGrantRequest $request): JsonResponse
    {
        $result = app(ProxyLoginForWebClientAction::class)->run($request);

        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
