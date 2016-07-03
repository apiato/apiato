<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Kernel\Task\Abstracts\Task;

/**
 * Class DeleteUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserTask constructor.
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
