<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\SubAction;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\UpdateOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

class LoginSubAction extends SubAction
{
    public function __construct(
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly UpdateOAuthIdentityTask $updateOAuthIdentityTask,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     * @throws ValidatorException
     */
    public function run(string $provider, User $oAuthUser): SuccessfulSocialAuthOutcome
    {
        $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());
        $identity = $this->updateOAuthIdentityTask->run($identity->getKey(), $oAuthUser);

        return new SuccessfulSocialAuthOutcome($identity);
    }
}
