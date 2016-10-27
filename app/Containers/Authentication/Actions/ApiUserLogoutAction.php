<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiLogoutTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ApiUserLogoutAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ApiUserLogoutAction extends Action
{

    /**
     * @var  \App\Containers\Authentication\Tasks\ApiLogoutTask
     */
    private $apiLogoutTask;

    /**
     * ApiUserLogoutAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\ApiLogoutTask $apiLogoutTask
     */
    public function __construct(ApiLogoutTask $apiLogoutTask)
    {
        $this->apiLogoutTask = $apiLogoutTask;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run($authorizationHeader)
    {
        $hasLoggedOut = $this->apiLogoutTask->run($authorizationHeader);

        return $hasLoggedOut;
    }
}
