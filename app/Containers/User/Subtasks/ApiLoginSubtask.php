<?php

namespace App\Containers\User\Subtasks;

use App\Services\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Kernel\Subtask\Abstracts\Subtask;

/**
 * Class CreateUserSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginSubtask extends Subtask
{

    /**
     * @var \App\Services\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * ApiLoginSubtask constructor.
     *
     * @param \App\Services\ApiAuthentication\Portals\ApiAuthenticationService $authenticationService
     */
    public function __construct(ApiAuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($email, $password)
    {
        $token = $this->authenticationService->login($email, $password);

        $user = $this->authenticationService->getAuthenticatedUser($token);

        return $user;
    }
}
