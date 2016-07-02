<?php

namespace App\Containers\User\Subtasks;

use App\Kernel\Subtask\Abstracts\Subtask;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Services\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;

/**
 * Class ListAllUsersSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersSubtask extends Subtask
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAllUsersSubtask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $this->userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());

        $users = $this->userRepository->paginate();

        return $users;
    }
}
