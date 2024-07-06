<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;

class FindOAuthIdentityByUserIdTask extends Task
{
    public function __construct(
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     */
    public function run(string $provider, string $user_id): OAuthIdentity
    {
        $identity = $this->oAuthIdentityRepository->findWhere([
            'provider' => $provider,
            'user_id' => $user_id,
        ])->first();

        return $identity ?? throw new OAuthIdentityNotFoundException();
    }
}
