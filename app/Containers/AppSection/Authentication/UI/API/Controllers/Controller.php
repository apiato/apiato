<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\AppSection\Authentication\Actions\ProxyLoginForWebClientAction;
use App\Containers\AppSection\Authentication\Actions\ProxyRefreshForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyLoginPasswordGrantRequest;
use App\Containers\AppSection\Authentication\UI\API\Requests\ProxyRefreshRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class Controller extends ApiController
{
    public function logout(LogoutRequest $request): JsonResponse
    {
        Apiato::call(ApiLogoutAction::class, [$request]);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget('refreshToken'));
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
        $result = Apiato::call(ProxyLoginForWebClientAction::class, [$request]);
        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
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
        $result = Apiato::call(ProxyRefreshForWebClientAction::class, [$request]);
        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
