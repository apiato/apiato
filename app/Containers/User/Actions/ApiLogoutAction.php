<?php

namespace App\Containers\User\Actions;

use App\Port\Action\Abstracts\Action;
use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;

/**
 * Class ApiLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutAction extends Action
{

    /**
     * @var \App\Containers\User\Actions\ApiAuthenticationService|\App\Containers\ApiAuthentication\Services\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * ApiLogoutAction constructor.
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
        $ok = $this->authenticationService->logout($authorizationHeader);

        return $ok;
    }
}
