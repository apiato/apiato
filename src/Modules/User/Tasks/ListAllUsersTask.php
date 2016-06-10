<?php

namespace Hello\Modules\User\Tasks;

use Hello\Modules\User\Contracts\UserRepositoryInterface;
use Hello\Modules\Core\Repository\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use Hello\Modules\Core\Task\Abstracts\Task;

/**
 * Class ListAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersTask extends Task
{

    /**
     * @var \Hello\Modules\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAllUsersTask constructor.
     *
     * @param \Hello\Modules\User\Contracts\UserRepositoryInterface $userRepository
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
