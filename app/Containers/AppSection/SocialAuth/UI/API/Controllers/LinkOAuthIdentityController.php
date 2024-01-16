<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\LoginByCodeAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginByCodeRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class LinkOAuthIdentityController extends ApiController
{
    public function __construct(
        private readonly LoginByCodeAction $loginAction,
    ) {
    }

    public function __invoke(LoginByCodeRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $result = $this->loginAction->transactionalRun($provider);

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, config('vendor-socialAuth.user.transformer'));
    }
}
