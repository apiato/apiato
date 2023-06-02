<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class ApiLogoutController extends ApiController
{
    public function __construct(
        private readonly ApiLogoutAction $logoutAction
    ) {
    }

    public function __invoke(LogoutRequest $request): JsonResponse
    {
        $this->logoutAction->run($request);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget('refreshToken'));
    }
}
