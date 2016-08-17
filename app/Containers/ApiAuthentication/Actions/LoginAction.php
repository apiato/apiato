<?php

namespace App\Containers\ApiAuthentication\Actions;

use App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class LoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginAction extends Action
{

    private $authenticationTask;

    /**
     * ApiLoginAction constructor.
     *
     * @param \App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask $authenticationTask
     */
    public function __construct(ApiAuthenticationTask $authenticationTask)
    {
        $this->authenticationTask = $authenticationTask;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($email, $password)
    {
        $token = $this->authenticationTask->login($email, $password);

        $user = $this->authenticationTask->getAuthenticatedUser($token);

        return $user;
    }
}
