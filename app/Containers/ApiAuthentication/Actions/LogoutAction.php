<?php

namespace App\Containers\ApiAuthentication\Actions;

use App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ApiLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutAction extends Action
{

    /**
     * @var  \App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask
     */
    private $authenticationTask;

    /**
     * LogoutAction constructor.
     *
     * @param \App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask $authenticationTask
     */
    public function __construct(
        ApiAuthenticationTask $authenticationTask
    ) {
        $this->authenticationTask = $authenticationTask;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run($authorizationHeader)
    {
        $hasLoggedOut = $this->authenticationTask->logout($authorizationHeader);

        return $hasLoggedOut;
    }
}
