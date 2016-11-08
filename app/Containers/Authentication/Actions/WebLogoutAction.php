<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebLogoutTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class WebLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLogoutAction extends Action
{

    /**
     * @var  \App\Containers\Authentication\Tasks\WebLogoutTask
     */
    private $webLogoutTask;

    /**
     * LogoutAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\WebLogoutTask $webLogoutTask
     */
    public function __construct(WebLogoutTask $webLogoutTask)
    {
        $this->webLogoutTask = $webLogoutTask;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run()
    {
        $hasLoggedOut = $this->webLogoutTask->run();

        return $hasLoggedOut;
    }
}
