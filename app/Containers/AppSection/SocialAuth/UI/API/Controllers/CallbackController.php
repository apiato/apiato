<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\LoginAction;
use App\Containers\AppSection\SocialAuth\Actions\SignupAction;
use App\Containers\AppSection\SocialAuth\Enums\AuthAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\AuthCallbackRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class CallbackController extends ApiController
{
    public function __construct(
        private readonly LoginAction $socialLoginAction,
        private readonly SignupAction $socialSignupAction,
    ) {
    }

    public function __invoke(AuthCallbackRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        if (AuthAction::Login->value === $request->state) {
            $result = $this->socialLoginAction->transactionalRun($provider);
        } else {
            $result = $this->socialSignupAction->transactionalRun($provider);
        }

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, config('vendor-socialAuth.user.transformer'));
    }
}
