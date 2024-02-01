<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Tasks\StatefulGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class StatefulSignupByCodeAction extends Action
{
    public function __construct(
        private readonly StatefulGetOAuthUserFromCodeTask $statefulGetOAuthUserFromCodeTask,
        private readonly SignupSubAction $signupSubAction,
    ) {
    }

    /**
     * @throws ValidatorException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->statefulGetOAuthUserFromCodeTask->run($provider);

        return $this->signupSubAction->run($provider, $oAuthUser);
    }
}
