<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers\WebClient;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\Api\WebClient\RefreshTokenAction;
use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\UI\API\Requests\WebClient\RefreshTokenRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class RefreshTokenController extends ApiController
{
    public function __invoke(RefreshTokenRequest $request, RefreshTokenAction $action): JsonResponse
    {
        $result = $action->run(
            RefreshToken::create($request->input(
                'refresh_token',
                $request->cookie(Token::refreshTokenCookieName()),
            )),
        );

        return Response::json(Response::create($result, TokenTransformer::class)->toArray())
            ->withCookie($result->refreshTokenCookie);
    }
}
