<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityLinkingFailedException;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

final class UnlinkOAuthIdentityAction extends Action
{
    public function __construct(
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     * @throws OAuthIdentityLinkingFailedException
     */
    public function run(Model&MustVerifyEmail $user, string $provider, string $socialId): void
    {
        $identity = $this->findOAuthIdentityTask->run($provider, $socialId);

        if ($identity->user->isNot($user)) {
            throw new OAuthIdentityLinkingFailedException('This account is not linked to this user.');
        }

        $identity->unlinkUser();
    }
}
