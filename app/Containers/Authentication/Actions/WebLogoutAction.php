<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class WebLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLogoutAction extends Action
{

    /**
     * @var  \App\Containers\Authentication\Tasks\WebAuthenticationTask
     */
    private $webAuthenticationTask;

    /**
     * LogoutAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\WebAuthenticationTask $webAuthenticationTask
     */
    public function __construct(WebAuthenticationTask $webAuthenticationTask)
    {
        $this->webAuthenticationTask = $webAuthenticationTask;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run()
    {
        $hasLoggedOut = $this->webAuthenticationTask->logout();

        return $hasLoggedOut;
    }
}
