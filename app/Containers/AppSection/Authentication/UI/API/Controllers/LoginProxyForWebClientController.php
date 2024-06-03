<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class LoginProxyForWebClientController extends ApiController
{
    public function __invoke(LoginProxyPasswordGrantRequest $request, ApiLoginProxyForWebClientAction $action): JsonResponse
    {
        $result = $action->run($request);

        return Response::createFrom($result->token)
            ->transformWith(TokenTransformer::class)
            ->ok()->withCookie($result->refreshTokenCookie);
    }
}
