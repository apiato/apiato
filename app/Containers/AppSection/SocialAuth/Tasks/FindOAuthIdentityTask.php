<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;

class FindOAuthIdentityTask extends Task
{
    public function __construct(
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     */
    public function run(string $provider, string $socialId): OAuthIdentity
    {
        $identity = $this->oAuthIdentityRepository->findWhere([
            'provider' => $provider,
            'social_id' => $socialId,
        ])->first();

        return $identity ?? throw new OAuthIdentityNotFoundException();
    }
}
