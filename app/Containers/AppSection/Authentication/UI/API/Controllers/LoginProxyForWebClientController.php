<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class LoginProxyForWebClientController extends ApiController
{
    public function __invoke(LoginProxyPasswordGrantRequest $request, ApiLoginProxyForWebClientAction $action): JsonResponse
    {
        $result = $action->run($request);

        return $this->json(Fractal::create($result->token, TokenTransformer::class)->toArray())->withCookie($result->refreshTokenCookie);
    }
}
