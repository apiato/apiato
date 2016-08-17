<?php

namespace App\Containers\User\Tasks;

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
     * @param $id
     *
     * @return  mixed
     */
    public function run()
    {
        return $this->auth->user();
    }

}
