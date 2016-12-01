<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
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
     * @var  \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * DeleteUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\DeleteUserTask                     $deleteUserTask
     * @param \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(DeleteUserTask $deleteUserTask, GetAuthenticatedUserTask $getAuthenticatedUserTask)
    {
        $this->deleteUserTask = $deleteUserTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param $userId
     *
     * @return  bool
     */
    public function run($userId = null)
    {
        if(!$userId){
            $userId = $this->getAuthenticatedUserTask->run()->id;
        }

        $isDeleted = $this->deleteUserTask->run($userId);

        return $isDeleted;
    }
}
