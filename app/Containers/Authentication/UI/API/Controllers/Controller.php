<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;
use App\Containers\Authentication\UI\API\Requests\ProxyRefreshRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function logout(LogoutRequest $request): JsonResponse
    {
        Apiato::call('Authentication@ApiLogoutAction', [$request]);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ]);
    }

    /**
     * This `proxyLoginForWebClient` exist only because we have `WebClient`
     * The more clients (Web Apps). Each client you add in the future, must have
     * similar functions here, with custom route for dedicated for each client
     * to be used as proxy when contacting the OAuth server.
     * This is only to help the Web Apps (JavaScript clients) hide
     * their ID's and Secrets when contacting the OAuth server and obtain Tokens.
     *
     * @param ProxyLoginPasswordGrantRequest $request
     *
     * @return JsonResponse
     */
    public function proxyLoginForWebClient(ProxyLoginPasswordGrantRequest $request): JsonResponse
    {
        $result = Apiato::call('Authentication@ProxyLoginForWebClientAction', [$request]);
        return $this->json($result);
    }

    /**
     * Read the comment in the function `proxyLoginForWebClient`
     *
     * @param ProxyRefreshRequest $request
     *
     * @return JsonResponse
     */
    public function proxyRefreshForWebClient(ProxyRefreshRequest $request): JsonResponse
    {
        $result = Apiato::call('Authentication@ProxyRefreshForWebClientAction', [$request]);
        return $this->json($result);
    }
}
