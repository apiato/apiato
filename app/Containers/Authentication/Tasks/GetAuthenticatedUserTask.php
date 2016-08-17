<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Port\Task\Abstracts\Task;
use Illuminate\Auth\AuthManager as Auth;

/**
 * Class GetAuthenticatedUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAuthenticatedUserTask extends Task
{

    /**
     * @var  \App\Containers\User\Tasks\Auth
     */
    private $auth;

    /**
     * GetAuthenticatedUserTask constructor.
     *
     * @param \App\Containers\User\Tasks\Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * get the user object of the current authenticated user.
     * If token was passed as param then inject it in the returned user object.
     *
     * @param null $token
     *
     * @return mixed
     */
    public function run($token = null)
    {
        if (!$user = $this->auth->user()) {
            throw new AuthenticationFailedException('User is not logged in.');
        }

        return $token ? $user->injectToken($token) : $user;
    }

}
