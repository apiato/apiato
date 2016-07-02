<?php

namespace App\Containers\Email\Subtasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Kernel\Subtask\Abstracts\Subtask;

/**
 * Class SetUserEmailSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailSubtask extends Subtask
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
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($userId, $email)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new UserNotFoundException;
        }

        $user->email = $email;
        $user->save();

        return $user;
    }
}
