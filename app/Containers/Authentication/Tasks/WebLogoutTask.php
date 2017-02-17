<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Auth\AuthManager as Auth;

/**
 * Class WebLogoutTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLogoutTask extends Task
{

    /**
     * @var  \Illuminate\Auth\AuthManager
     */
    private $auth;

    /**
     * WebAuthenticationTask constructor.
     *
     * @param \Illuminate\Auth\AuthManager $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return  bool
     */
    public function run()
    {
        $this->auth->logout();

        return true;
    }

}
