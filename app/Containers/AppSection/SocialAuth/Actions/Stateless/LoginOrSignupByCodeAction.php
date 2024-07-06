<?php

namespace App\Containers\AppSection\SocialAuth\Actions\Stateless;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Actions\LoginOrSignupSubAction;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Exceptions\SignupFailedException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginOrSignupByCodeRequest;
use App\Containers\AppSection\SocialAuth\Values\FailedSocialAuthOutcome;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;
use Prettus\Validator\Exceptions\ValidatorException;

final class LoginOrSignupByCodeAction extends Action
{
    public function __construct(
        private readonly SocialiteManager $socialiteManager,
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly LoginOrSignupSubAction $signupSubAction,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws SignupFailedException
     * @throws SignupFailedException
     */
    public function run(LoginOrSignupByCodeRequest $request, string $provider): SuccessfulSocialAuthOutcome|FailedSocialAuthOutcome
    {
        /* @var AbstractProvider $driver */
        $driver = $this->socialiteManager->with($provider);
        $driver = $driver->stateless();
        if ($request->has('redirect_url')) {
            $driver->redirectUrl($request->redirect_url);
        }
        // We let user log in with both code and token
        if ($request->has('code')) {
            $oAuthUser = $driver->user();
        } else {
            $oAuthUser = $driver->userFromToken($request->input('access_token'));
        }

        try {
            // TODO: Remove duplicated logic
            // This line is duplicated in
            // LoginOrSignupSubAction::class
            // How can we prevent this?
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());

            return new SuccessfulSocialAuthOutcome($identity);
        } catch (OAuthIdentityNotFoundException) {
            if ($request->has('code')) {
                // TODO: remove. Only for testing purposes
                // $oAuthUser->email = null;
                $identity = OAuthIdentity::fromOAuthUser($oAuthUser, $provider);

                return new FailedSocialAuthOutcome($identity, $oAuthUser->token);
            }

            if ($request->has('access_token')) {
                // TODO: remove. Only for testing purposes
                // $oAuthUser->email = null;
                if (null === $oAuthUser->getEmail() && !$request->has('email')) {
                    throw new SignupFailedException('Email is required');
                }

                $oAuthUser->email = $oAuthUser->email ?? $request->input('email');

                return $this->signupSubAction->run($provider, $oAuthUser);
            }

            throw new SignupFailedException('Invalid request');
        }
    }
}
