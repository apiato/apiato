<?php

namespace App\Containers\AppSection\SocialAuth\UI\WEB\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Controller extends WebController
{
    public function redirect($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider): string
    {
        $user = Socialite::driver($provider)->user();

        return $user->getEmail();
    }
}
