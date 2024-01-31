<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\StatelessLoginByCodeAction;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginByCodeRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class LoginByCodeController extends ApiController
{
    public function __construct(
        private readonly StatelessLoginByCodeAction $statelessLoginByCodeAction,
    ) {
    }

    public function __invoke(LoginByCodeRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $result = $this->statelessLoginByCodeAction->transactionalRun($provider);

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, SocialAuth::userTransformer());
    }
}
