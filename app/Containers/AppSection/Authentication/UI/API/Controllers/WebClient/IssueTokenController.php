<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers\WebClient;

use App\Containers\AppSection\Authentication\Actions\Api\WebClient\IssueTokenAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\WebClient\IssueTokenRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class IssueTokenController extends ApiController
{
    public function __invoke(IssueTokenRequest $request, IssueTokenAction $action): JsonResponse
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
