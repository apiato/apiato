<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
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
     * @var  \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * UpdateUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\UpdateUserTask                     $updateUserTask
     * @param \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(UpdateUserTask $updateUserTask, GetAuthenticatedUserTask $getAuthenticatedUserTask)
    {
        $this->updateUserTask = $updateUserTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param null $password
     * @param null $name
     * @param null $email
     * @param null $gender
     * @param null $birth
     *
     * @return  mixed
     */
    public function run($password = null, $name = null, $email = null, $gender = null, $birth = null)
    {
        $userId = $this->getAuthenticatedUserTask->run()->id;

        $user = $this->updateUserTask->run($userId, $password, $name, $email, $gender, $birth);

        return $user;
    }
}
