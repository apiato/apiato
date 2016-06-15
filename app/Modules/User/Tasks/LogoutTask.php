<?php

namespace App\Modules\User\Tasks;

use App\Services\Authentication\Portals\AuthenticationService;
use App\Modules\Core\Task\Abstracts\Task;

/**
 * Class LogoutTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutTask extends Task
{

    /**
     * @var \App\Modules\User\Tasks\AuthenticationService|\App\Services\Authentication\Portals\AuthenticationService
     */
    private $authenticationService;

    /**
     * LogoutTask constructor.
     *
     * @param \App\Services\Authentication\Portals\AuthenticationService $authenticationService
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
