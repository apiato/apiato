<?php

namespace App\Containers\User\Subtasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Kernel\Subtask\Abstracts\Subtask;

/**
 * Class DeleteUserSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserSubtask extends Subtask
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserSubtask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $userId
     *
     * @return bool
     */
    public function run($userId)
    {
        // delete the record from the users table.
        $this->userRepository->delete($userId);

        return true;
    }
}
