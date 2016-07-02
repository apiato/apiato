<?php

namespace App\Containers\User\Subtasks;

use App\Services\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Kernel\Subtask\Abstracts\Subtask;

/**
 * Class ApiLogoutSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutSubtask extends Subtask
{

    /**
     * @var \App\Containers\User\Subtasks\ApiAuthenticationService|\App\Services\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * ApiLogoutSubtask constructor.
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
