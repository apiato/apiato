<?php

namespace App\Containers\User\Tasks;

use App\Services\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Engine\Task\Abstracts\Task;

/**
 * Class ApiLogoutTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutTask extends Task
{

    /**
     * @var \App\Containers\User\Tasks\ApiAuthenticationService|\App\Services\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * ApiLogoutTask constructor.
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
