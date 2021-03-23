<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;
use App\Containers\Authentication\UI\API\Requests\ProxyRefreshRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class Controller extends ApiController
{
    public function logout(LogoutRequest $request): JsonResponse
    {
        Apiato::call('Authentication@ApiLogoutAction', [$request]);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget('refreshToken'));
    }

    /**
     * This `proxyLoginForAdminWebClient` exist only because we have `AdminWebClient`
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
    public function proxyLoginForAdminWebClient(ProxyLoginPasswordGrantRequest $request): JsonResponse
    {
        $result = Apiato::call('Authentication@ProxyLoginForAdminWebClientAction', [$request]);
        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }

    /**
     * Read the comment in the function `proxyLoginForAdminWebClient`
     *
     * @param ProxyRefreshRequest $request
     *
     * @return JsonResponse
     */
    public function proxyRefreshForAdminWebClient(ProxyRefreshRequest $request): JsonResponse
    {
        $result = Apiato::call('Authentication@ProxyRefreshForAdminWebClientAction', [$request]);
        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
