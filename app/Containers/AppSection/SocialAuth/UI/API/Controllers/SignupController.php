<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\SignupAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\SignupRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class SignupController extends ApiController
{
    public function __construct(
        private readonly SignupAction $signupAction,
    ) {
    }

    public function __invoke(SignupRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $result = $this->signupAction->transactionalRun($provider);

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, config('vendor-socialAuth.user.transformer'));
    }
}
