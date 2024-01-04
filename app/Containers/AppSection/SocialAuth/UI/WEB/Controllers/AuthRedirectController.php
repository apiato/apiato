<?php

namespace App\Containers\AppSection\SocialAuth\UI\WEB\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class AuthRedirectController extends WebController
{
    public function __invoke($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }
}
