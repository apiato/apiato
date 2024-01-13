<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\AuthRedirectRequest;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class AuthRedirectController extends ApiController
{
    public function __construct(
        private readonly SocialiteManager $socialiteManager,
    ) {
    }

    public function __invoke(AuthRedirectRequest $request, string $provider): RedirectResponse
    {
        /* @var AbstractProvider $providerInstance */
        $providerInstance = $this->socialiteManager->driver($provider);
        return $providerInstance->with(['state' => $request->action])->stateless()->redirect();
    }
}
