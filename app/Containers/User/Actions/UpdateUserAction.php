<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\UpdateUserTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class UpdateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\UpdateUserTask
     */
    private $updateUserTask;

    /**
     * UpdateUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\UpdateUserTask $updateUserTask
     */
    public function __construct(UpdateUserTask $updateUserTask)
    {
        $this->updateUserTask = $updateUserTask;
    }

    /**
     * @param      $userId
     * @param null $password
     * @param null $name
     * @param null $email
     *
     * @return  mixed
     */
    public function run($userId, $password = null, $name = null, $email = null)
    {
        $user = $this->updateUserTask->run($userId, $password, $name, $email);

        return $user;
    }
}
