<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Contracts\UserRepositoryInterface;
use App\Modules\Core\Task\Abstracts\Task;

/**
 * Class DeleteUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTask extends Task
{

    /**
     * @var \App\Modules\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserTask constructor.
     *
     * @param \App\Modules\User\Contracts\UserRepositoryInterface $userRepository
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
