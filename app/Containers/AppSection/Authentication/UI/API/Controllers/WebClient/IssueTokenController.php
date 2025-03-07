<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers\WebClient;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\Api\WebClient\IssueTokenAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\WebClient\IssueTokenRequest;
use App\Containers\AppSection\Authentication\UI\API\Transformers\AccessTokenTransformer;
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

        return Response::create($result, AccessTokenTransformer::class)->ok()
            ->withCookie($result->refreshTokenCookie);
    }
}
