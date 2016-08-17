<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ApiLogoutAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ApiLogoutAction extends Action
{

    /**
     * @var  \App\Containers\Authentication\Tasks\ApiAuthenticationTask
     */
    private $apiAuthenticationTask;

    /**
     * ApiLogoutAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\ApiAuthenticationTask $apiAuthenticationTask
     */
    public function __construct(
        ApiAuthenticationTask $apiAuthenticationTask
    ) {
        $this->apiAuthenticationTask = $apiAuthenticationTask;
    }

    /**
     * @param $authorizationHeader
     *
     * @return bool
     */
    public function run($authorizationHeader)
    {
        $hasLoggedOut = $this->apiAuthenticationTask->logout($authorizationHeader);

        return $hasLoggedOut;
    }
}
