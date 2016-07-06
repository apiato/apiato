<?php

namespace App\Containers\User\Actions;

use App\Services\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Kernel\Action\Abstracts\Action;

/**
 * Class ApiLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutAction extends Action
{

    /**
     * @var \App\Containers\User\Actions\ApiAuthenticationService|\App\Services\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * ApiLogoutAction constructor.
     *
     * @param \App\Services\ApiAuthentication\Portals\ApiAuthenticationService $authenticationService
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
