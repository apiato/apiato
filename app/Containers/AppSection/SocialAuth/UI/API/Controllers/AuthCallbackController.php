<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\SocialLoginAction;
use App\Containers\AppSection\SocialAuth\Actions\SocialSignupAction;
use App\Containers\AppSection\SocialAuth\Enums\AuthAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\AuthCallbackRequest;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthResult;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;

final class AuthCallbackController extends ApiController
{
    public function __construct(
        private readonly SocialiteManager $socialiteManager,
        private readonly SocialLoginAction $socialLoginAction,
        private readonly SocialSignupAction $socialSignupAction,
    ) {
    }

    public function __invoke(AuthCallbackRequest $request, string $provider)
    {
        /* @var AbstractProvider $providerInstance */
        $providerInstance = $this->socialiteManager->driver($provider);
        $oAuthUser = $providerInstance->stateless()->user();

        /* @var SocialAuthResult $result */
        if (AuthAction::Login->value === $request->state) {
            $result = $this->socialLoginAction->transactionalRun($provider, $oAuthUser);
        } else {
            $result = $this->socialSignupAction->transactionalRun($provider, $oAuthUser);
        }

        return $this->withMeta(
            [
                'token_type' => 'personal',
                'access_token' => $result->token->accessToken,
                'expires_in' => $result->token->token->expires_at->diffInSeconds(),
            ],
        )->transform($result->user, config('vendor-socialAuth.user.transformer'));
    }
}
