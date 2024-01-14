<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\GetOAuthUserTask;
use App\Containers\AppSection\SocialAuth\Tasks\UpdateOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

final class LoginAction extends Action
{
    public function __construct(
        private readonly GetOAuthUserTask $getOAuthUserTask,
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly UpdateOAuthIdentityTask $updateOAuthIdentityTask,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws OAuthIdentityNotFoundException
     * @throws \JsonException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->getOAuthUserTask->run($provider);
        $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser);
        $identity = $this->updateOAuthIdentityTask->run($identity->id, $oAuthUser);

        if ($this->shouldVerifyEmail($identity->user, $oAuthUser)) {
            $identity->user->markEmailAsVerified();
        }

        return new SocialAuthOutcome($identity);
    }

    private function shouldVerifyEmail(mixed $user, User $oAuthUser): bool
    {
        return $this->isEmailMatching($user, $oAuthUser) && !$user->hasVerifiedEmail();
    }

    private function isEmailMatching(mixed $user, User $oAuthUser): bool
    {
        return $user->email === $oAuthUser->email;
    }
}
