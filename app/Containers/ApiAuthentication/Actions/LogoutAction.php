<?php

namespace App\Containers\ApiAuthentication\Actions;

use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;
use App\Port\Action\Abstracts\Action;

/**
 * Class ApiLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutAction extends Action
{

    /**
     * @var  \App\Containers\ApiAuthentication\Services\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * LogoutAction constructor.
     *
     * @param \App\Containers\ApiAuthentication\Services\ApiAuthenticationService $authenticationService
     */
    public function __construct(
        ApiAuthenticationService $authenticationService
    ) {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run($authorizationHeader)
    {
        $hasLoggedOut = $this->authenticationService->logout($authorizationHeader);

        return $hasLoggedOut;
    }
}
