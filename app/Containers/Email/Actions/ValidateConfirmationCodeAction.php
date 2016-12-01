<?php

namespace App\Containers\Email\Actions;

use App\Containers\Email\Tasks\ConfirmUserEmailTask;
use App\Containers\Email\Tasks\ValidateConfirmationCodeTask;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ValidateUserEmailByConfirmationCodeAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidateUserEmailByConfirmationCodeAction extends Action
{

    /**
     * @var  \App\Containers\Email\Tasks\ValidateConfirmationCodeTask
     */
    private $validateConfirmationCodeTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * @var  \App\Containers\Email\Tasks\ConfirmUserEmailTask
     */
    private $confirmUserEmailTask;

    /**
     * ValidateConfirmationCodeAction constructor.
     *
     * @param \App\Containers\Email\Tasks\ValidateConfirmationCodeTask $validateConfirmationCodeTask
     * @param \App\Containers\User\Tasks\FindUserByIdTask              $findUserByIdTask
     * @param \App\Containers\Email\Tasks\ConfirmUserEmailTask         $confirmUserEmailTask
     */
    public function __construct(
        ValidateConfirmationCodeTask $validateConfirmationCodeTask,
        FindUserByIdTask $findUserByIdTask,
        ConfirmUserEmailTask $confirmUserEmailTask
    ) {
        $this->validateConfirmationCodeTask = $validateConfirmationCodeTask;
        $this->findUserByIdTask = $findUserByIdTask;
        $this->confirmUserEmailTask = $confirmUserEmailTask;
    }

    /**
     * @param $userId
     * @param $code
     *
     * @return  bool
     * @throws \App\Containers\User\Tasks\UserNotFoundException
     */
    public function run($userId, $code)
    {
        $this->validateConfirmationCodeTask->run($userId, $code);

        // TODO: can replace both tasks below with a single task to reduce the queries from 2 to 1
        //       the query can be Update (confirmed = true) by User ID

        $user = $this->findUserByIdTask->run($userId);

        $this->confirmUserEmailTask->run($user);

        return true;
    }
}
