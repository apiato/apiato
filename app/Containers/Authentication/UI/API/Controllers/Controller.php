<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Containers\Authentication\Data\Transporters\ProxyRefreshTransporter;
use App\Containers\Authentication\UI\API\Requests\LoginRequest;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\Authentication\UI\API\Requests\RefreshRequest;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{
    public function logout(LogoutRequest $request): JsonResponse
    {
        $dataTransporter = new DataTransporter($request);
        $dataTransporter->bearerToken = $request->bearerToken();

        Apiato::call('Authentication@ApiLogoutAction', [$dataTransporter]);

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
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function proxyLoginForAdminWebClient(LoginRequest $request): JsonResponse
    {
        $dataTransporter = new ProxyApiLoginTransporter(
            array_merge($request->all(), [
                'client_id' => Config::get('authentication-container.clients.web.admin.id'),
                'client_password' => Config::get('authentication-container.clients.web.admin.secret')
            ])
        );

        $result = Apiato::call('Authentication@ApiLoginProxyAction', [$dataTransporter]);

        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }

    /**
     * Read the comment in the function `proxyLoginForAdminWebClient`
     *
     * @param RefreshRequest $request
     *
     * @return JsonResponse
     */
    public function proxyRefreshForAdminWebClient(RefreshRequest $request): JsonResponse
    {
        $dataTransporter = new ProxyRefreshTransporter(
            array_merge($request->all(), [
                'client_id' => Config::get('authentication-container.clients.web.admin.id'),
                'client_password' => Config::get('authentication-container.clients.web.admin.secret'),
                // use the refresh token sent in request data, if not exist try to get it from the cookie
                'refresh_token' => $request->refresh_token ?: $request->cookie('refreshToken'),
            ])
        );

        $result = Apiato::call('Authentication@ApiRefreshProxyAction', [$dataTransporter]);

        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
