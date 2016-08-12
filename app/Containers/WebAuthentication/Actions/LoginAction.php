<?php

namespace App\Containers\WebAuthentication\Actions;

use App\Containers\WebAuthentication\Services\WebAuthenticationService;
use App\Port\Action\Abstracts\Action;

/**
 * Class LoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginAction extends Action
{

    /**
     * @var  \App\Containers\WebAuthentication\Services\WebAuthenticationService
     */
    private $authenticationService;

    /**
     * LoginAction constructor.
     *
     * @param \App\Containers\WebAuthentication\Services\WebAuthenticationService $authenticationService
     */
    public function __construct(WebAuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param $email
     * @param $password
     * @param $remember
     *
     * @return  mixed
     */
    public function run($email, $password, $remember)
    {
        $user = $this->authenticationService->login($email, $password, $remember);

        return $user;
    }
}
