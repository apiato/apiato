<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityAlreadyLinkedException;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\StatelessGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\VerifyEmailTask;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Prettus\Validator\Exceptions\ValidatorException;

final class LinkOAuthIdentityAction extends Action
{
    /**
     * @throws \Exception
     */
    public function __construct(
        private readonly StatelessGetOAuthUserFromCodeTask $statelessGetOAuthUserFromCodeTask,
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly StoreOAuthIdentityTask $storeOAuthIdentityTask,
        private readonly VerifyEmailTask $verifyEmailTask,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws \JsonException
     * @throws \Exception
     */
    public function run(Model|MustVerifyEmail $user, string $provider): void
    {
        $oAuthUser = $this->statelessGetOAuthUserFromCodeTask->run($provider);

        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());

            if ($identity->user->getKey() !== $user->getKey()) {
                throw new OAuthIdentityAlreadyLinkedException('This account is already linked to another user.');
            }

            throw new OAuthIdentityAlreadyLinkedException('This account is already linked to this user.');
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider, $oAuthUser);
            $this->linkIdentityToUser($identity, $user);

            if (config('vendor-socialAuth.auto_verify_email' && $user instanceof MustVerifyEmail)) {
                // Here we assume that the user has already verified their email address on the OAuth provider's side.
                $this->verifyEmailTask->run($user, $oAuthUser->getEmail());
            }
        }
    }

    private function linkIdentityToUser(OAuthIdentity $identity, Model $user): void
    {
        $identity->user()->associate($user);
        $identity->save();
    }
}
