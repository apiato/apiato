<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Actions\ApiRefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissingException;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RefreshProxyForWebClientController extends ApiController
{
    /**
     * This `refreshProxyForWebClient` exist only because we have `WebClient`
     * The more clients (Web Apps). Each client you add in the future, must have
     * similar functions here, with custom route for dedicated for each client
     * to be used as proxy when contacting the OAuth server.
     * This is only to help the Web Apps (JavaScript clients) hide
     * their ID's and Secrets when contacting the OAuth server and obtain Tokens.
     *
     * @param RefreshProxyRequest $request
     * @return JsonResponse
     * @throws LoginFailedException
     * @throws RefreshTokenMissingException
     * @throws IncorrectIdException
     */
    public function refreshProxyForWebClient(RefreshProxyRequest $request): JsonResponse
    {
        $result = app(ApiRefreshProxyForWebClientAction::class)->run($request);

        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
