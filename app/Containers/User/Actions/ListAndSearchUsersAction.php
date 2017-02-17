<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\ListUsersTask;
use App\Ship\Action\Abstracts\Action;

/**
 * Class ListAndSearchUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAndSearchUsersAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\ListUsersTask
     */
    private $listUsersTask;

    /**
     * ListAndSearchUsersAction constructor.
     *
     * @param \App\Containers\User\Tasks\ListUsersTask $listUsersTask
     */
    public function __construct(ListUsersTask $listUsersTask)
    {
        $this->listUsersTask = $listUsersTask;
    }

    /**
     * @param null $roles
     * @param bool $order
     *
     * @return  mixed
     */
    public function run($roles = null, $order = true)
    {
        $users = $this->listUsersTask->run($order, $roles);

        return $users;
    }
}
