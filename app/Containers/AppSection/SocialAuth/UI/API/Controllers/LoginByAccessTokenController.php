<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\LoginByAccessTokenAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginByAccessTokenRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class LoginByAccessTokenController extends ApiController
{
    public function __construct(
        private readonly LoginByAccessTokenAction $loginByAccessTokenAction,
    ) {
    }

    public function __invoke(LoginByAccessTokenRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $result = $this->loginByAccessTokenAction->transactionalRun($provider);

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, config('vendor-socialAuth.user.transformer'));
    }
}
