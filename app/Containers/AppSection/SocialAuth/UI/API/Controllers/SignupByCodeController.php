<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\StatelessSignupByCodeAction;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\SignupByCodeRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class SignupByCodeController extends ApiController
{
    public function __construct(
        private readonly StatelessSignupByCodeAction $statelessSignupByCodeAction,
    ) {
    }

    public function __invoke(SignupByCodeRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $result = $this->statelessSignupByCodeAction->transactionalRun($provider);

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token)->toArray(),
        )->transform($result->user, SocialAuth::userTransformer());
    }
}
