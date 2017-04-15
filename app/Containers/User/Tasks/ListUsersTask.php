<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Data\Criterias\NoRolesCriteria;
use App\Containers\User\Data\Criterias\RoleCriteria;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Actions\Action;

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
     * * The search text is auto-magically applied.
     *
     * @param bool $order
     * @param bool $allUsers
     * @param null $roles
     *
     * @return  mixed
     */
    public function run($order = true, $allUsers = false, $roles = null)
    {
        // if he doesn't need all users means he might need to filter by roles
        if (!$allUsers) {
            if ($roles) {
                $this->userRepository->pushCriteria(new RoleCriteria($roles));
            }else{
                // if no roles specified means he wants only users with has no roles (normal clients usually)
                $this->userRepository->pushCriteria(new NoRolesCriteria());
            }
        }

        if ($order) {
            $this->userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        }

        return $this->userRepository->paginate();
    }
}
