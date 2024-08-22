<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\RefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RefreshProxyForWebClientController extends ApiController
{
    public function __invoke(RefreshProxyRequest $request, RefreshProxyForWebClientAction $action): JsonResponse
    {
        $result = $action->run($request);

        return Response::createFrom($result->token)
            ->transformWith(TokenTransformer::class)
            ->ok()->withCookie($result->refreshTokenCookie);
    }
}
