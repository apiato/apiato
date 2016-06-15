<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Contracts\UserRepositoryInterface;
use App\Modules\Core\Repository\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Modules\Core\Task\Abstracts\Task;

/**
 * Class ListAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersTask extends Task
{

    /**
     * @var \App\Modules\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAllUsersTask constructor.
     *
     * @param \App\Modules\User\Contracts\UserRepositoryInterface $userRepository
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
