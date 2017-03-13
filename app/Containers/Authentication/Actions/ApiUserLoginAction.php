<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiLoginWithCredentialsTask;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Http\Request;
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
     * @param Request $request
     *
     * @return mixed
     */
    public function run(Request $request)
    {
        $token = $this->apiLoginWithCredentialsTask->run($request);

        $user = $this->getAuthenticatedUserTask->run();
        $user->token = $token;

        return $user;
    }
}
