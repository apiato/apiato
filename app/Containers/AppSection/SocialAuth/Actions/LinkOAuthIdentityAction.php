<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityLinkingFailedException;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\StatelessGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\VerifyEmailTask;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Prettus\Validator\Exceptions\ValidatorException;
use Webmozart\Assert\Assert;

final class LinkOAuthIdentityAction extends Action
{
    public function __construct(
        private readonly StatelessGetOAuthUserFromCodeTask $statelessGetOAuthUserFromCodeTask,
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly StoreOAuthIdentityTask $storeOAuthIdentityTask,
        private readonly VerifyEmailTask $verifyEmailTask,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws OAuthIdentityLinkingFailedException
     */
    public function run(Model|MustVerifyEmail $user, string $provider): Model|MustVerifyEmail
    {
        Assert::isInstanceOf($user, Model::class);
        $oAuthUser = $this->statelessGetOAuthUserFromCodeTask->run($provider);

        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());

            if ($identity->user->is($user)) {
                throw new OAuthIdentityLinkingFailedException('This account is already linked to this user.');
            }
            if ($identity->user->isNot($user)) {
                throw new OAuthIdentityLinkingFailedException('This account is already linked to another user.');
            }
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider, $oAuthUser);
            $identity->linkUser($user);
            $this->verifyEmailTask->run($user, $oAuthUser->getEmail());
        }

        return $user;
    }
}
