<?php

namespace App\Containers\AppSection\SocialAuth\UI\WEB\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\StatefulLoginByCodeAction;
use App\Containers\AppSection\SocialAuth\Actions\StatefulSignupByCodeAction;
use App\Containers\AppSection\SocialAuth\Enums\AuthAction;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use App\Containers\AppSection\SocialAuth\UI\WEB\Requests\CallbackRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class CallbackController extends ApiController
{
    public function __construct(
        private readonly StatefulLoginByCodeAction  $statefulLoginByCodeAction,
        private readonly StatefulSignupByCodeAction $statefulSignupByCodeAction,
    ) {
    }

    // TODO: Separate login and sighup actions by using different routes.
    public function __invoke(CallbackRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        if (AuthAction::Login->value === $request->state) {
            $result = $this->statefulLoginByCodeAction->transactionalRun($provider);
        } else {
            $result = $this->statefulSignupByCodeAction->transactionalRun($provider);
        }

        // TODO: This works! But we need to find a way to securely return the token to the client.
        // return redirect()->away('http://example.com');
        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, SocialAuth::userTransformer());
    }
}
