<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authorization\Tasks\IsUserAdminTask;
use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class WebAdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAdminLoginAction extends Action
{

    /**
     * @var  \App\Containers\Authentication\Tasks\WebLoginTask
     */
    private $webLoginTask;

    /**
     * @var  \App\Containers\Authentication\Tasks\IsUserAdminTask
     */
    private $isUserAdminTask;

    /**
     * LoginAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\WebLoginTask            $webLoginTask
     * @param \App\Containers\Authentication\Tasks\IsUserAdminTask $isUserAdminTask
     */
    public function __construct(WebLoginTask $webLoginTask, IsUserAdminTask $isUserAdminTask)
    {
        $this->webLoginTask = $webLoginTask;
        $this->isUserAdminTask = $isUserAdminTask;
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
        $user = $this->webLoginTask->run($email, $password, $remember);

        $this->isUserAdminTask->run($user);

        return $user;
    }
}
