<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityLinkingFailedException;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityByUserIdTask;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use Illuminate\Database\Eloquent\Model;

final class UnlinkOAuthIdentityAction extends Action
{
    public function __construct(
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly FindOAuthIdentityByUserIdTask $findOAuthIdentityByUserIdTask,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     * @throws OAuthIdentityLinkingFailedException
     */
    public function run(string $provider, ?string $socialId): Model
    {
        if ($socialId) {
            $identity = $this->findOAuthIdentityTask->run($provider, $socialId);
        } else {
            $user = auth()->user();
            $identity = $this->findOAuthIdentityByUserIdTask->run($provider, $user->getId());
        }

        if ($identity->user->isNot($user)) {
            throw new OAuthIdentityLinkingFailedException('This account is not linked to this user.');
        }

        $identity->unlinkUser();

        return $user->load('oauthIdentities');
    }
}
