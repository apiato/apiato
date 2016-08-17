<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Tasks\FindUserByIdTask;
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
     * @var  \App\Containers\User\Tasks\FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * FindUserByIdAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByIdTask $findUserByIdTask
     */
    public function __construct(
        FindUserByIdTask $findUserByIdTask
    ) {
        $this->findUserByIdTask = $findUserByIdTask;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        try {
            $user = $this->findUserByIdTask->run($id);
        } catch (Exception $e) {
            throw new UserNotFoundException;
        }

        return $user;
    }
}
