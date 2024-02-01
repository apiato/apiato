<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Exceptions\OAuthIdentityNotFoundException;
use App\Containers\AppSection\SocialAuth\Tasks\StatelessGetOAuthUserFromCodeTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class StatelessLoginByCodeAction extends Action
{
    public function __construct(
        private readonly StatelessGetOAuthUserFromCodeTask $statelessGetOAuthUserFromCodeTask,
        private readonly LoginSubAction $loginSubAction,
    ) {
    }

    /**
     * @throws OAuthIdentityNotFoundException
     * @throws ValidatorException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->statelessGetOAuthUserFromCodeTask->run($provider);

        return $this->loginSubAction->run($provider, $oAuthUser);
    }
}
