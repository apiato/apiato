<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class GetOAuthUserFromCodeTask extends Task
{
    public function __construct(
        private readonly SocialiteManager $socialiteManager,
    ) {
    }

    public function run(string $provider): User
    {
        /* @var AbstractProvider $driver */
        $driver = $this->socialiteManager->with($provider);

        return $driver->enablePKCE()->user();
    }
}
