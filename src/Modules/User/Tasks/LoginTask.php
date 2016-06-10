<?php

namespace Hello\Modules\User\Tasks;

use Hello\Services\Authentication\Portals\AuthenticationService;
use Hello\Services\Core\Task\Abstracts\Task;

/**
 * Class CreateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginTask extends Task
{

    /**
     * @var \Hello\Services\Authentication\Portals\AuthenticationService
     */
    private $authenticationService;

    /**
     * LoginTask constructor.
     *
     * @param \Hello\Services\Authentication\Portals\AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService)
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
