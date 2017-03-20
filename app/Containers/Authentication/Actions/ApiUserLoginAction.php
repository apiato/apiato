<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiLoginWithCredentialsTask;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Engine\Butlers\Facades\Call;
use App\Ship\Parents\Actions\Action;

/**
 * Class ApiUserLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiUserLoginAction extends Action
{
    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($email, $password)
    {
        $token = $this->call(ApiLoginWithCredentialsTask::class, [$email, $password]);

        $user = $this->call(GetAuthenticatedUserTask::class, [$token]);

        return $user;
    }
}
