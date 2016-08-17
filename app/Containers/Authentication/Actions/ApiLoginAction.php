<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ApiLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginAction extends Action
{

    private $apiAuthenticationTask;

    /**
     * ApiLoginAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\ApiAuthenticationTask $apiAuthenticationTask
     */
    public function __construct(ApiAuthenticationTask $apiAuthenticationTask)
    {
        $this->apiAuthenticationTask = $apiAuthenticationTask;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($email, $password)
    {
        $token = $this->apiAuthenticationTask->login($email, $password);

        $user = $this->apiAuthenticationTask->getAuthenticatedUser($token);

        return $user;
    }
}
