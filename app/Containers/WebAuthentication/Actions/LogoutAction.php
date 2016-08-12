<?php

namespace App\Containers\WebAuthentication\Actions;

use App\Containers\WebAuthentication\Services\WebAuthenticationService;
use App\Port\Action\Abstracts\Action;

/**
 * Class WebLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutAction extends Action
{

    /**
     * @var  \App\Containers\WebAuthentication\Services\WebAuthenticationService
     */
    private $authenticationService;

    /**
     * LogoutAction constructor.
     *
     * @param \App\Containers\WebAuthentication\Services\WebAuthenticationService $authenticationService
     */
    public function __construct(
        WebAuthenticationService $authenticationService
    ) {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run()
    {
        $hasLoggedOut = $this->authenticationService->logout();

        return $hasLoggedOut;
    }
}
