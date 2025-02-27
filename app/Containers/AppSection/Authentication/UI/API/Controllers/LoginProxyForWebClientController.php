<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class LoginProxyForWebClientController extends ApiController
{
    public function __invoke(LoginProxyPasswordGrantRequest $request, ApiLoginProxyForWebClientAction $action): JsonResponse
    {
        $result = $action->run(
            UserCredential::create(
                $request->input('email'),
                $request->input('password'),
            ),
        );

        return $this->json($this->transform($result, TokenTransformer::class))
            ->withCookie($result->refreshTokenCookie);
    }
}
