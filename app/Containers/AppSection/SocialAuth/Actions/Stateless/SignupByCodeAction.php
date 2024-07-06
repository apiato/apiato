<?php

namespace App\Containers\AppSection\SocialAuth\Actions\Stateless;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Actions\LoginOrSignupSubAction;
use App\Containers\AppSection\SocialAuth\Tasks\StatelessGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class SignupByCodeAction extends Action
{
    public function __construct(
        private readonly StatelessGetOAuthUserFromCodeTask $statelessGetOAuthUserFromCodeTask,
        private readonly LoginOrSignupSubAction $loginOrSignupSubAction,
    ) {
    }

    /**
     * @throws ValidatorException
     */
    public function run(string $provider): SuccessfulSocialAuthOutcome
    {
        $oAuthUser = $this->statelessGetOAuthUserFromCodeTask->run($provider);

        return $this->loginOrSignupSubAction->run($provider, $oAuthUser);
    }
}
