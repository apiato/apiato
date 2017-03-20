<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiLogoutTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ApiUserLogoutAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ApiUserLogoutAction extends Action
{

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run($authorizationHeader)
    {
        $hasLoggedOut = $this->call(ApiLogoutTask::class, [$authorizationHeader]);

        return $hasLoggedOut;
    }
}
