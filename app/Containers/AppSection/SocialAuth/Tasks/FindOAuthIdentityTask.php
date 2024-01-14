<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Laravel\Socialite\Two\User;

class FindOAuthIdentityTask extends Task
{
    public function __construct(
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     */
    public function run(string $provider, User $oAuthUser): OAuthIdentity
    {
        $identity = $this->oAuthIdentityRepository->findWhere([
            'provider' => $provider,
            'social_id' => $oAuthUser->id,
        ])->first();

        return $identity ?? throw new OAuthIdentityNotFoundException();
    }
}
