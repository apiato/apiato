<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Settings\Contracts\UserRepositoryInterface;
use App\Port\Action\Abstracts\Action;
use App\Port\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;

/**
 * Class ListAllUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersAction extends Action
{

    /**
     * @var \App\Containers\User\Settings\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ListAllUsersAction constructor.
     *
     * @param \App\Containers\User\Settings\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
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
