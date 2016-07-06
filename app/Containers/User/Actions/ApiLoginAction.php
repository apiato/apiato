<?php

namespace App\Containers\User\Actions;

use App\Portainers\ApiAuthentication\Portals\ApiAuthenticationService;
use App\Ship\Action\Abstracts\Action;

/**
 * Class CreateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginAction extends Action
{

    /**
     * @var \App\Portainers\ApiAuthentication\Portals\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * ApiLoginAction constructor.
     *
     * @param \App\Portainers\ApiAuthentication\Portals\ApiAuthenticationService $authenticationService
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
