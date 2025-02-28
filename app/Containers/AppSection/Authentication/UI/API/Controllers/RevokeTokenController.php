<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\Api\RevokeTokenAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RevokeTokenRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class RevokeTokenController extends ApiController
{
    public function __invoke(RevokeTokenRequest $request, RevokeTokenAction $action): JsonResponse
    {
        $cookies = $action->run($request->user());

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie($cookies);
    }
}
