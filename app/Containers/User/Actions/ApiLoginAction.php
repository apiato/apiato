<?php

namespace App\Containers\User\Actions;

use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;
use App\Port\Action\Abstracts\Action;

/**
 * Class ApiLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginAction extends Action
{

    private $authenticationService;


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
