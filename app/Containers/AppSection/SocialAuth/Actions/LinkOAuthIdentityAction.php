<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\GetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Prettus\Validator\Exceptions\ValidatorException;

final class LinkOAuthIdentityAction extends Action
{
    public function __construct(
        private readonly GetOAuthUserFromCodeTask $getOAuthUserFromCodeTask,
        private readonly FindOAuthIdentityTask    $findOAuthIdentityTask,
        private readonly StoreOAuthIdentityTask   $storeOAuthIdentityTask,
        private readonly AuthManager              $authManager,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->getOAuthUserFromCodeTask->run($provider);

        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider, $oAuthUser);
            $user = $this->authManager->user();
            // TODO: Verify email if linked email is the same
            $this->linkIdentityToUser($identity, $user);
        }

        return new SocialAuthOutcome($identity);
    }

    private function linkIdentityToUser(OAuthIdentity $identity, Authenticatable $user): void
    {
        $identity->user()->associate($user);
        $identity->save();
    }
}
