<?php

namespace App\Containers\User\Tasks;

use App\Containers\Core\Task\Abstracts\Task;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Services\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;

/**
 * Class ListAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAllUsersTask constructor.
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
