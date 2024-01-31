<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use Apiato\Core\Exceptions\AuthenticationException;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityAlreadyLinkedException;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\StatelessGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\VerifyEmailTask;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Prettus\Validator\Exceptions\ValidatorException;

final class LinkOAuthIdentityAction extends Action
{
    private readonly Authenticatable&MustVerifyEmail $user;

    /**
     * @throws AuthenticationException
     * @throws \Exception
     */
    public function __construct(
        private readonly StatelessGetOAuthUserFromCodeTask $statelessGetOAuthUserFromCodeTask,
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly StoreOAuthIdentityTask $storeOAuthIdentityTask,
        private readonly AuthManager $authManager,
        private readonly VerifyEmailTask $verifyEmailTask,
    ) {
        if ($this->authManager->guest()) {
            throw new AuthenticationException('User is not authenticated.');
        }

        if (!$this->authManager->user() instanceof MustVerifyEmail) {
            // TODO: Throw a more specific exception.
            throw new \Exception('User must implement Illuminate\Contracts\Auth\MustVerifyEmail\MustVerifyEmail.');
        }

        $this->user = $this->authManager->user();
    }

    /**
     * @throws ValidatorException
     * @throws \JsonException
     * @throws \Exception
     */
    public function run(string $provider): void
    {
        $oAuthUser = $this->statelessGetOAuthUserFromCodeTask->run($provider);

        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());

            if ($identity->user->id !== $this->user->id) {
                throw new OAuthIdentityAlreadyLinkedException('This account is already linked to another user.');
            }

            throw new OAuthIdentityAlreadyLinkedException('This account is already linked to this user.');
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider, $oAuthUser);
            // TODO: Do we need to verify email/something?
            // What if someone sits in front of the computer and tries to link a bunch of accounts to a user?
            $this->linkIdentityToUser($identity, $this->user);
            $this->verifyEmailTask->run($this->user, $oAuthUser->getEmail());
        }
    }

    private function linkIdentityToUser(OAuthIdentity $identity, Authenticatable $user): void
    {
        $identity->user()->associate($user);
        $identity->save();
    }
}
