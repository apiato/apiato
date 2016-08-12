<?php

namespace App\Containers\ApiAuthentication\Actions;

use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;
use App\Port\Action\Abstracts\Action;

/**
 * Class LoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginAction extends Action
{

    private $authenticationService;

    /**
     * ApiLoginAction constructor.
     *
     * @param \App\Containers\ApiAuthentication\Services\ApiAuthenticationService $authenticationService
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
