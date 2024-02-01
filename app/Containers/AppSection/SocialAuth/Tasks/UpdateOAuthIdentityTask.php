<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

class UpdateOAuthIdentityTask extends Task
{
    public function __construct(
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
    ) {
    }

    /**
     * @throws ValidatorException
     */
    public function run(int $id, User $oAuthUser): OAuthIdentity
    {
        return $this->oAuthIdentityRepository->update([
            'nickname' => $oAuthUser->getNickname(),
            'name' => $oAuthUser->getName(),
            'email' => $oAuthUser->getEmail(),
            'avatar' => $oAuthUser->getAvatar(),
        ], $id);
    }
}
