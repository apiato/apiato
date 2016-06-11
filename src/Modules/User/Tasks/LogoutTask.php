<?php

namespace Hello\Modules\User\Tasks;

use Hello\Services\Authentication\Portals\AuthenticationService;
use Hello\Modules\Core\Task\Abstracts\Task;

/**
 * Class LogoutTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutTask extends Task
{

    /**
     * @var \Hello\Modules\User\Tasks\AuthenticationService|\Hello\Services\Authentication\Portals\AuthenticationService
     */
    private $authenticationService;

    /**
     * LogoutTask constructor.
     *
     * @param \Hello\Services\Authentication\Portals\AuthenticationService $authenticationService
     */
    public function __construct(
        AuthenticationService $authenticationService
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
