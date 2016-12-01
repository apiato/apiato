<?php

namespace App\Containers\Email\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Port\Task\Abstracts\Task;

/**
 * Class SetUserEmailTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailTask extends Task
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
     * @param $email
     *
     * @return  mixed
     */
    public function run($userId, $email)
    {
        $user = $this->userRepository->find($userId);
        $user->email = $email;
        $user->save();

        return $user;
    }
}
