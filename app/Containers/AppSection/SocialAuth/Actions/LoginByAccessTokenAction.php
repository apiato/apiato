<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;
use Prettus\Validator\Exceptions\ValidatorException;

final class LoginByAccessTokenAction extends Action
{
    public function __construct(
        private readonly SocialiteManager $socialiteManager,
        private readonly LoginSubAction $loginSubAction,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider, string $accessToken): SocialAuthOutcome
    {
        /* @var AbstractProvider $driver */
        $driver = $this->socialiteManager->with($provider);
        $oAuthUser = $driver->stateless()->userFromToken($accessToken);

        return $this->loginSubAction->run($provider, $oAuthUser);
    }
}
