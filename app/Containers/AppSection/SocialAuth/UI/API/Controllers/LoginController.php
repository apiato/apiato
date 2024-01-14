<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\LoginAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class LoginController extends ApiController
{
    public function __construct(
        private readonly LoginAction $loginAction,
    ) {
    }

    public function __invoke(LoginRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $result = $this->loginAction->transactionalRun($provider);

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, config('vendor-socialAuth.user.transformer'));
    }
}
