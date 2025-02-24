<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\RefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Data\Dto\WebClient\RefreshProxy;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class RefreshProxyForWebClientController extends ApiController
{
    public function __invoke(RefreshProxyRequest $request, RefreshProxyForWebClientAction $action): JsonResponse
    {
        $result = $action->run(
            RefreshProxy::create(
                $request->input(
                    'refresh_token',
                    $request->cookie('refreshToken'),
                ),
            ),
        );

        return $this->json($this->transform($result->token, TokenTransformer::class))
            ->withCookie($result->refreshTokenCookie);
    }
}
