<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Port\Task\Abstracts\Task;
use Exception;

/**
 * Class FindUserByIdTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * FindUserByIdTask constructor.
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
     * @return  mixed
     * @throws \App\Containers\User\Tasks\UserNotFoundException
     */
    public function run($userId)
    {
        // find the user by its id
        try {
            $user = $this->userRepository->find($userId);
        } catch (Exception $e) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
