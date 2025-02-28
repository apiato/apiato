<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\Api\RevokeTokenAction;
use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\UI\API\Requests\RevokeTokenRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

final class RevokeTokenController extends ApiController
{
    public function __invoke(RevokeTokenRequest $request, RevokeTokenAction $action): JsonResponse
    {
        $action->run($request->user());

        // TODO: shouldn't the cookie be sent back by the action?
        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget(Token::refreshTokenCookieName()));
    }
}
