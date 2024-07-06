<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\SubAction;
use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use App\Containers\AppSection\SocialAuth\Tasks\FindOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\StoreOAuthIdentityTask;
use App\Containers\AppSection\SocialAuth\Tasks\VerifyEmailTask;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use App\Ship\Exceptions\CreateResourceFailedException;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

class LoginOrSignupSubAction extends SubAction
{
    public function __construct(
        private readonly FindOAuthIdentityTask $findOAuthIdentityTask,
        private readonly StoreOAuthIdentityTask $storeOAuthIdentityTask,
        private readonly VerifyEmailTask $verifyEmailTask,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws IncorrectIdException
     * @throws CreateResourceFailedException
     */
    public function run(string $provider, User $oAuthUser): SuccessfulSocialAuthOutcome
    {
        try {
            $identity = $this->findOAuthIdentityTask->run($provider, $oAuthUser->getId());
        } catch (OAuthIdentityNotFoundException) {
            $identity = $this->storeOAuthIdentityTask->run($provider, $oAuthUser);

            // TODO: create an interface for this:
            // registerUserAction should have a run method
            // that accepts an array of user data
            // $user = SocialAuth::registerUserAction()->run(request());
            $request = request();
            if ($identity->getEmail()) {
                // add email to the request
                $request->merge(['email' => $identity->getEmail()]);
            }

            $user = app(RegisterUserAction::class)->run(RegisterUserRequest::createFrom($request));
            $identity->linkUser($user);
            $this->verifyEmailTask->run($user, $oAuthUser->getEmail());
        }

        return new SuccessfulSocialAuthOutcome($identity);
    }
}
