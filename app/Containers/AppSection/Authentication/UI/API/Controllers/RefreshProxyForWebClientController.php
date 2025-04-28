<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\RefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RefreshProxyForWebClientController extends ApiController
{
    public function __invoke(RefreshProxyRequest $request, RefreshProxyForWebClientAction $action): JsonResponse
    {
        $authResult = $action->run($request);

        return $this->json($this->transform($authResult->token, TokenTransformer::class))->withCookie($authResult->refreshTokenCookie);
    }
}
