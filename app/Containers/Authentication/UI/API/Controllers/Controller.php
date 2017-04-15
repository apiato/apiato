<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use App\Containers\Authentication\Actions\ApiLogoutAction;
use App\Containers\Authentication\Actions\ProxyApiLoginAction;
use App\Containers\Authentication\Actions\ProxyApiRefreshAction;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
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
     * @param \App\Containers\Authentication\UI\API\Requests\LogoutRequest $request
     * @param \App\Containers\Authentication\Actions\ProxyApiLoginAction   $action
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function proxyLoginForAdminWebClient(LogoutRequest $request, ProxyApiLoginAction $action)
    {
        $result = $action->run($request->email, $request->password, 'AdminWeb');

        return $this->json($result['content'])->withCookie($result['refreshCookie']);
    }

    /**
     * @param LogoutRequest         $request
     * @param ProxyApiRefreshAction $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function proxyRefreshForAdminWebClient(LogoutRequest $request, ProxyApiRefreshAction $action)
    {
        $result = $action->run($request->cookie('refreshToken'), 'AdminWeb');

        return $this->json($result['content'])->withCookie($result['refreshCookie']);
    }
}
