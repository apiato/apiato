<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class LoginProxyForWebClientController extends ApiController
{
    public function __construct(
        private readonly ApiLoginProxyForWebClientAction $apiLoginProxyForWebClientAction,
    ) {
    }

    public function __invoke(LoginProxyPasswordGrantRequest $request): JsonResponse
    {
        $result = $this->apiLoginProxyForWebClientAction->run($request);

        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }
}
