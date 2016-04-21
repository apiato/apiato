<?php

namespace Mega\Modules\User\Tasks;

use Mega\Services\Core\Task\Abstracts\Task;
use Mega\Services\Core\Repository\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use Mega\Modules\User\Contracts\UserRepositoryInterface;

/**
 * Class ListAllUsersTask.
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersTask extends Task
{
    /**
     * @var \Mega\Modules\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAllUsersTask constructor.
     *
     * @param \Mega\Modules\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param \Mega\Modules\User\Contracts\UserRepositoryInterface $userRepository
     *
     * @return mixed
     */
    public function run()
    {
        $this->userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());

        $users = $this->userRepository->paginate();

        return $users;
    }
}
