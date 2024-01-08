<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\AuthRedirectRequest;
use Laravel\Socialite\SocialiteManager;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class AuthRedirectController extends ApiController
{
    public function __construct(
        private readonly SocialiteManager $socialiteManager,
    ) {
    }

    public function __invoke(AuthRedirectRequest $request, string $provider): RedirectResponse
    {
        return $this->socialiteManager->driver($provider)->with(['state' => $request->action])->stateless()->redirect();
    }
}
