<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\ListUsersTask;
use App\Port\Action\Abstracts\Action;

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
     * The search text is auto-magically applied.
     *
     * @param bool|true $order
     *
     * @return  mixed
     */
    public function run($order = true)
    {
        $users = $this->listUsersTask->run($order);

        return $users;
    }
}
