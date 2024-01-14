<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use Apiato\Core\Abstracts\Models\UserModel;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\GetOAuthUserTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class SignupAction extends Action
{
    public function __construct(
        private readonly GetOAuthUserTask $getOAuthUserTask,
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
        $oAuthUser = $this->getOAuthUserTask->run($provider);

        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser);
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider,$oAuthUser);
            $user = $this->createVerifiedUser($identity, $oAuthUser->email);
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
