<?php

namespace App\Modules\User\Tasks;

use App\Services\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Modules\Core\Task\Abstracts\Task;

/**
 * Class CreateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginTask extends Task
{

    /**
     * @var \App\Services\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * LoginTask constructor.
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
