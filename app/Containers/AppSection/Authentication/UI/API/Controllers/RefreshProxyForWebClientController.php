<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\RefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class RefreshProxyForWebClientController extends ApiController
{
    public function __invoke(RefreshProxyRequest $request, RefreshProxyForWebClientAction $action): JsonResponse
    {
        // TODO who should decide if refresh token can be null or not? RefreshToken, Proxy, Controller or Action?
        $result = $action->run(
            RefreshToken::create($request->input(
                'refresh_token',
                $request->cookie(Token::refreshTokenCookieName()),
            )),
        );

        return $this->json($this->transform($result, TokenTransformer::class))
            ->withCookie($result->refreshTokenCookie);
    }
}
