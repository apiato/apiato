<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use Apiato\Core\Abstracts\Models\UserModel;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\StatefulGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class StatefulSignupByCodeAction extends Action
{
    public function __construct(
        private readonly StatefulGetOAuthUserFromCodeTask $statefulGetOAuthUserFromCodeTask,
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly StoreOAuthIdentityTask $storeOAuthIdentityTask,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->statefulGetOAuthUserFromCodeTask->run($provider);

        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider, $oAuthUser);
            // TODO: What if user is registered via a provider that doesn't provide email? e.g., Twitter or Facebook
            //            if (!$oAuthUser->getEmail())
            //                throw new \Exception('Email not provided by provider'
            // TODO: What if the user email is not verified? (In provider).
            // Can we assume that the user email is verified if the user is registered via a provider?
            $user = $this->createVerifiedUser($identity, $oAuthUser->getEmail());
            $this->linkIdentityToUser($identity, $user);
        }

        return new SocialAuthOutcome($identity);
    }

    private function createVerifiedUser(OAuthIdentity $identity, string $email): UserModel
    {
        $user = $identity->user()->create(compact('email'));
        $user->markEmailAsVerified();

        return $user;
    }

    private function linkIdentityToUser(OAuthIdentity $identity, UserModel $user): void
    {
        $identity->user()->associate($user);
        $identity->save();
    }
}
