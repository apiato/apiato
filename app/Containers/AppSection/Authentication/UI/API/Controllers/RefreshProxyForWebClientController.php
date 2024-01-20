<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiRefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RefreshProxyForWebClientController extends ApiController
{
    public function __construct(
        private readonly ApiRefreshProxyForWebClientAction $apiRefreshProxyForWebClientAction,
    ) {
    }

    public function __invoke(RefreshProxyRequest $request): JsonResponse
    {
        $result = $this->apiRefreshProxyForWebClientAction->run($request);

        return $this->json($this->transform($result->token, TokenTransformer::class))->withCookie($result->refreshTokenCookie);
    }
}
