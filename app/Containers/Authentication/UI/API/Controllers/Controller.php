<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use App\Containers\Authentication\Actions\ApiLogoutAction;
use App\Containers\Authentication\Actions\ProxyApiLoginAction;
use App\Containers\Authentication\Actions\ProxyApiRefreshAction;
use App\Containers\Authentication\UI\API\Requests\LoginRequest;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\Authentication\UI\API\Requests\RefreshRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Support\Facades\Cookie;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\Authentication\UI\API\Requests\LogoutRequest $request
     * @param \App\Containers\Authentication\Actions\ApiLogoutAction       $action
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutRequest $request, ApiLogoutAction $action)
    {
        $action->run($request->bearerToken());

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
     * @param \App\Containers\Authentication\UI\API\Requests\LoginRequest $request
     * @param \App\Containers\Authentication\Actions\ProxyApiLoginAction  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function proxyLoginForAdminWebClient(LoginRequest $request, ProxyApiLoginAction $action)
    {
        $result = $action->run(
            env('CLIENT_WEB_ADMIN_ID'),
            env('CLIENT_WEB_ADMIN_SECRET'),
            $request->email,
            $request->password
        );

        return $this->json($result['response-content'])->withCookie($result['refresh-cookie']);
    }

    /**
     * Read the comment in the function `proxyLoginForAdminWebClient`
     *
     * @param \App\Containers\Authentication\UI\API\Requests\RefreshRequest $request
     * @param \App\Containers\Authentication\Actions\ProxyApiRefreshAction  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function proxyRefreshForAdminWebClient(RefreshRequest $request, ProxyApiRefreshAction $action)
    {
        $result = $action->run(
            env('CLIENT_WEB_ADMIN_ID'),
            env('CLIENT_WEB_ADMIN_SECRET'),
            $request->cookie('refreshToken')
        );

        return $this->json($result['response-content'])->withCookie($result['refresh-cookie']);
    }
}
