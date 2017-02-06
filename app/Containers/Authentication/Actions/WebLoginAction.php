<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{

    /**
     * @var  \App\Containers\Authentication\Tasks\WebLoginTask
     */
    private $webLoginTask;

    /**
     * LoginAction constructor.
     *
     * @param \App\Containers\Authentication\Tasks\WebLoginTask $webLoginTask
     */
    public function __construct(WebLoginTask $webLoginTask)
    {
        $this->webLoginTask = $webLoginTask;
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
        $user = $this->webLoginTask->run($email, $password, $remember);

        return $user;
    }
}
