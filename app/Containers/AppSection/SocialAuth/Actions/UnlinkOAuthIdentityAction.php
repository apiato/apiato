<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use Apiato\Core\Exceptions\AuthenticationException;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

final class UnlinkOAuthIdentityAction extends Action
{
    private readonly Authenticatable&MustVerifyEmail $user;

    /**
     * @throws AuthenticationException
     * @throws \Exception
     */
    public function __construct(
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly AuthManager $authManager,
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
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
     * @throws \Exception
     */
    public function run(string $provider, string $socialId): void
    {
        $identity = $this->findOAuthIdentityTask->run($provider, $socialId);

        if ($identity->user->id !== $this->user->id) {
            // TODO: Throw a more specific exception.
            throw new \Exception('Cannot unlink OAuth identity from another user.');
        }

        $this->unlinkIdentityFromToUser($identity);
        $this->oAuthIdentityRepository->delete($identity->id);
    }

    private function unlinkIdentityFromToUser(OAuthIdentity $identity): void
    {
        $identity->user()->disassociate();
        $identity->save();
    }
}
