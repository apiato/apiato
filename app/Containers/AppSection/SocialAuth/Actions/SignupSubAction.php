<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\SubAction;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Exceptions\SignupFailedException;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\VerifyEmailTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

class SignupSubAction extends SubAction
{
    public function __construct(
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly StoreOAuthIdentityTask $storeOAuthIdentityTask,
        private readonly VerifyEmailTask $verifyEmailTask,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws SignupFailedException
     */
    public function run(string $provider, User $oAuthUser): SocialAuthOutcome
    {
        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider, $oAuthUser);

            if (null === $oAuthUser->getEmail()) {
                throw new SignupFailedException('No email provided by the OAuth provider.');
            }

            $user = $identity->user()->create(['email' => $oAuthUser->getEmail()]);
            $identity->linkUser($user);
            $this->verifyEmailTask->run($user, $oAuthUser->getEmail());
        }

        return new SocialAuthOutcome($identity);
    }
}
