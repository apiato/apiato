<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\DeleteUserTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\DeleteUserTask
     */
    private $deleteUserTask;

    /**
     * DeleteUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\DeleteUserTask $deleteUserTask
     */
    public function __construct(DeleteUserTask $deleteUserTask)
    {
        $this->deleteUserTask = $deleteUserTask;
    }

    /**
     * @param $userId
     *
     * @return bool
     */
    public function run($userId)
    {
        $done = $this->deleteUserTask->run($userId);

        return $done;
    }
}
