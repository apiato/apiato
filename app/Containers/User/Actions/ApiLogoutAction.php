<?php

namespace App\Containers\User\Actions;

use App\Portainers\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Ship\Action\Abstracts\Action;

/**
 * Class ApiLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutAction extends Action
{

    /**
     * @var \App\Containers\User\Actions\ApiAuthenticationService|\App\Portainers\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * ApiLogoutAction constructor.
     *
     * @param \App\Portainers\ApiAuthentication\Portals\ApiAuthenticationService $authenticationService
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
        $ok = $this->authenticationService->logout($authorizationHeader);

        return $ok;
    }
}
