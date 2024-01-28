<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\SubAction;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\UpdateOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\VerifyEmailTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

class LoginSubAction extends SubAction
{
    public function __construct(
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly UpdateOAuthIdentityTask $updateOAuthIdentityTask,
        private readonly VerifyEmailTask $verifyEmailTask,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider, User $oAuthUser): SocialAuthOutcome
    {
        $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());
        $identity = $this->updateOAuthIdentityTask->run($identity->id, $oAuthUser);

        // TODO: What if the user email is not verified? (In provider).
        // Can we assume that the user email is verified if the user is registered via a provider?
        if (null === $oAuthUser->getEmail()) {
            $this->verifyEmailTask->run($identity->user, $oAuthUser->email);
        }

        return new SocialAuthOutcome($identity);
    }
}
