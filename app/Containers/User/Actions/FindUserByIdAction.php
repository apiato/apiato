<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Tasks\FindUserTask;
use App\Port\Action\Abstracts\Action;
use Exception;

/**
 * Class FindUserByIdAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdAction extends Action
{
    /**
     * @var  \App\Containers\User\Tasks\FindUserTask
     */
    private $findUserTask;

    /**
     * FindUserByIdAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserTask $findUserTask
     */
    public function __construct(
        FindUserTask $findUserTask
    ) {
        $this->findUserTask = $findUserTask;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        try {
            $user = $this->findUserTask->byId($id);
        } catch (Exception $e) {
            throw new UserNotFoundException;
        }

        return $user;
    }
}
