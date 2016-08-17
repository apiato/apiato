<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{

    /**
     * @var  \App\Containers\Authentication\Tasks\WebAuthenticationTask
     */
    private $webAuthenticationTask;

    /**
     * LoginAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\WebAuthenticationTask $webAuthenticationTask
     */
    public function __construct(WebAuthenticationTask $webAuthenticationTask)
    {
        $this->webAuthenticationTask = $webAuthenticationTask;
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
        $user = $this->webAuthenticationTask->login($email, $password, $remember);

        return $user;
    }
}
