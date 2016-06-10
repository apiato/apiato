<?php

namespace Hello\Modules\User\Tasks;

use Hello\Modules\User\Contracts\UserRepositoryInterface;
use Hello\Modules\Core\Task\Abstracts\Task;

/**
 * Class DeleteUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTask extends Task
{

    /**
     * @var \Hello\Modules\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserTask constructor.
     *
     * @param \Hello\Modules\User\Contracts\UserRepositoryInterface $userRepository
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
