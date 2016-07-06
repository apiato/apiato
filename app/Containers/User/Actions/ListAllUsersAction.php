<?php

namespace App\Containers\User\Actions;

use App\Ship\Action\Abstracts\Action;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Portainers\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;

/**
 * Class ListAllUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersAction extends Action
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAllUsersAction constructor.
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
