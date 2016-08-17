<?php

namespace App\Containers\WebAuthentication\Actions;

use App\Containers\WebAuthentication\Tasks\WebAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class WebLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutAction extends Action
{

    /**
     * @var  \App\Containers\WebAuthentication\Tasks\WebAuthenticationTask
     */
    private $authenticationTask;

    /**
     * LogoutAction constructor.
     *
     * @param \App\Containers\WebAuthentication\Tasks\WebAuthenticationTask $authenticationTask
     */
    public function __construct(
        WebAuthenticationTask $authenticationTask
    ) {
        $this->authenticationTask = $authenticationTask;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run()
    {
        $hasLoggedOut = $this->authenticationTask->logout();

        return $hasLoggedOut;
    }
}
