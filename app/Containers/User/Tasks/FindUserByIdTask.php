<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Task\Abstracts\Task;

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
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        // find the user by its id
        $user = $this->userRepository->find($id);

        return $user;
    }

}
