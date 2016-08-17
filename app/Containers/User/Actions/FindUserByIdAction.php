<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\FindUserByIdTask;
use App\Port\Action\Abstracts\Action;

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
        $user = $this->findUserByIdTask->run($id);

        return $user;
    }
}
