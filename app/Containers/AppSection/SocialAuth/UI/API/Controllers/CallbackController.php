<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\LoginByCodeAction;
use App\Containers\AppSection\SocialAuth\Actions\SignupByCodeAction;
use App\Containers\AppSection\SocialAuth\Enums\AuthAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\AuthCallbackRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class CallbackController extends ApiController
{
    public function __construct(
        private readonly LoginByCodeAction $socialLoginAction,
        private readonly SignupByCodeAction $socialSignupAction,
    ) {
    }

    // TODO: Separate login and sighup actions by using different routes.
    public function __invoke(AuthCallbackRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        if (AuthAction::Login->value === $request->state) {
            $result = $this->socialLoginAction->transactionalRun($provider);
        } else {
            $result = $this->socialSignupAction->transactionalRun($provider);
        }

        // TODO: This works! But we need a way to redirect back to the frontend with the token.
        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, config('vendor-socialAuth.user.transformer'));
    }
}
