<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ValidateUserIsAdminTask;
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
     * @var  \App\Containers\Authentication\Tasks\ValidateUserIsAdminTask
     */
    private $validateUserIsAdminTask;

    /**
     * LoginAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\WebLoginTask            $webLoginTask
     * @param \App\Containers\Authentication\Tasks\ValidateUserIsAdminTask $validateUserIsAdminTask
     */
    public function __construct(WebLoginTask $webLoginTask, ValidateUserIsAdminTask $validateUserIsAdminTask)
    {
        $this->webLoginTask = $webLoginTask;
        $this->validateUserIsAdminTask = $validateUserIsAdminTask;
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

        $this->validateUserIsAdminTask->run($user);

        return $user;
    }
}
