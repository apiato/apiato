<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Containers\Authentication\Tasks\WebAuthenticationTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class AdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AdminLoginAction extends Action
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
     * @return  array|mixed
     */
    public function run($email, $password, $remember)
    {
        try {
            $user = $this->webAuthenticationTask->login($email, $password, $remember);
        } catch (AuthenticationFailedException $e) {
            return ['message' => 'Authentication Failed.'];
        }

        // check if is Admin
        $isAdmin = $user->hasRole('admin');

        if (!$isAdmin) {
            return ['message' => 'User is not Admin.'];
        }

        return $user;
    }
}
