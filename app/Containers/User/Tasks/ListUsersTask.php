<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Data\Criterias\AdminsCriteria;
use App\Containers\User\Data\Criterias\RoleCriteria;
use App\Ship\Parents\Actions\Action;
use App\Ship\Features\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;

/**
 * Class ListUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListUsersTask extends Action
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAndSearchUsersAction constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * The search text is auto-magically applied.
     *
     * @param bool|true $order
     *
     * @return  mixed
     */
    public function run($order = true, $roles = null)
    {
        if ($order) {
            $this->userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        }

        if ($roles) {
            $this->userRepository->pushCriteria(new RoleCriteria($roles));
        }

        $users = $this->userRepository->paginate();

        return $users;
    }
}
