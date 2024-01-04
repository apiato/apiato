<?php

namespace App\Containers\AppSection\SocialAuth\UI\WEB\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController;
use Laravel\Socialite\Facades\Socialite;

final class CallbackController extends WebController
{
    public function __invoke($provider): string
    {
        $user = Socialite::driver($provider)->user();

        return $user->getEmail();
    }
}
