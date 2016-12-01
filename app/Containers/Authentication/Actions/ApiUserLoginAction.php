<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiLoginWithCredentialsTask;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ApiUserLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiUserLoginAction extends Action
{

    private $apiLoginWithCredentialsTask;

    /**
     * @var  \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * ApiUserLoginAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\ApiLoginWithCredentialsTask $apiLoginWithCredentialsTask
     * @param \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask    $getAuthenticatedUserTask
     */
    public function __construct(
        ApiLoginWithCredentialsTask $apiLoginWithCredentialsTask,
        GetAuthenticatedUserTask $getAuthenticatedUserTask
    ) {
        $this->apiLoginWithCredentialsTask = $apiLoginWithCredentialsTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($email, $password)
    {
        $token = $this->apiLoginWithCredentialsTask->run($email, $password);

        $user = $this->getAuthenticatedUserTask->run($token);

        return $user;
    }
}
