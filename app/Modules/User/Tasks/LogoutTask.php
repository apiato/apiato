<?php

namespace App\Modules\User\Tasks;

use App\Services\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Modules\Core\Task\Abstracts\Task;

/**
 * Class LogoutTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutTask extends Task
{

    /**
     * @var \App\Modules\User\Tasks\ApiAuthenticationService|\App\Services\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * LogoutTask constructor.
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
