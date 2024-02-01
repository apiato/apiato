<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Tasks\StatelessGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class StatelessSignupByCodeAction extends Action
{
    public function __construct(
        private readonly StatelessGetOAuthUserFromCodeTask $statelessGetOAuthUserFromCodeTask,
        private readonly SignupSubAction $signupSubAction,
    ) {
    }

    /**
     * @throws ValidatorException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->statelessGetOAuthUserFromCodeTask->run($provider);

        return $this->signupSubAction->run($provider, $oAuthUser);
    }
}
