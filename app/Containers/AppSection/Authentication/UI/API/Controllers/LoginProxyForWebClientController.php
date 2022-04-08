<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class LoginProxyForWebClientController extends ApiController
{
    /**
     * This `loginProxyForWebClient` exist only because we have `WebClient`
     * The more clients (Web Apps). Each client you add in the future, must have
     * similar functions here, with custom route for dedicated for each client
     * to be used as proxy when contacting the OAuth server.
     * This is only to help the Web Apps (JavaScript clients) hide
     * their ID's and Secrets when contacting the OAuth server and obtain Tokens.
     *
     * @param LoginProxyPasswordGrantRequest $request
     * @return JsonResponse
     * @throws LoginFailedException
     * @throws IncorrectIdException
     */
    public function loginProxyForWebClient(LoginProxyPasswordGrantRequest $request): JsonResponse
    {
        $result = app(ApiLoginProxyForWebClientAction::class)->run($request);

        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
