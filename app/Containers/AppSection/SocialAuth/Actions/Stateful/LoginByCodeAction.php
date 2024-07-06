<?php

namespace App\Containers\AppSection\SocialAuth\Actions\Stateful;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Actions\LoginSubAction;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\StatefulGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class LoginByCodeAction extends Action
{
    public function __construct(
        private readonly StatefulGetOAuthUserFromCodeTask $statefulGetOAuthUserFromCodeTask,
        private readonly LoginSubAction $loginSubAction,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     * @throws ValidatorException
     */
    public function run(string $provider): SuccessfulSocialAuthOutcome
    {
        $oAuthUser = $this->statefulGetOAuthUserFromCodeTask->run($provider);

        return $this->loginSubAction->run($provider, $oAuthUser);
    }
}
