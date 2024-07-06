<?php

namespace App\Containers\AppSection\SocialAuth\Actions\Stateful;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Actions\LoginOrSignupSubAction;
use App\Containers\AppSection\SocialAuth\Exceptions\SignupFailedException;
use App\Containers\AppSection\SocialAuth\Tasks\StatefulGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class SignupByCodeAction extends Action
{
    public function __construct(
        private readonly StatefulGetOAuthUserFromCodeTask $statefulGetOAuthUserFromCodeTask,
        private readonly LoginOrSignupSubAction $loginOrSignupSubAction,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws SignupFailedException
     */
    public function run(string $provider): SuccessfulSocialAuthOutcome
    {
        $oAuthUser = $this->statefulGetOAuthUserFromCodeTask->run($provider);

        return $this->loginOrSignupSubAction->run($provider, $oAuthUser);
    }
}
