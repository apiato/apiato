<?php

namespace App\Containers\WebAuthentication\Actions;

use App\Containers\WebAuthentication\Tasks\WebAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class LoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginAction extends Action
{

    /**
     * @var  \App\Containers\WebAuthentication\Tasks\WebAuthenticationTask
     */
    private $authenticationTask;

    /**
     * LoginAction constructor.
     *
     * @param \App\Containers\WebAuthentication\Tasks\WebAuthenticationTask $authenticationTask
     */
    public function __construct(WebAuthenticationTask $authenticationTask)
    {
        $this->authenticationTask = $authenticationTask;
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
        $user = $this->authenticationTask->login($email, $password, $remember);

        return $user;
    }
}
