<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

class StoreOAuthIdentityTask extends Task
{
    public function __construct(
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
    ) {
    }

    /**
     * @throws \JsonException
     * @throws ValidatorException
     */
    public function run(string $provider, User $oAuthUser): OAuthIdentity
    {
        return $this->oAuthIdentityRepository->create(
            [
                'provider' => $provider,
                'social_id' => $oAuthUser->getId(),
                'email' => $oAuthUser->getEmail(),
                'nickname' => $oAuthUser->getNickname(),
                'name' => $oAuthUser->getName(),
                'avatar' => $oAuthUser->getAvatar(),
                'token' => $oAuthUser->token,
                'refresh_token' => $oAuthUser->refreshToken,
                'expires_in' => $oAuthUser->expiresIn,
                'scopes' => json_encode($oAuthUser->approvedScopes, JSON_THROW_ON_ERROR),
            ],
        );
    }
}
