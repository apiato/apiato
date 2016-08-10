<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Action\Abstracts\Action;
use App\Port\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;

/**
 * Class ListAndSearchUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAndSearchUsersAction extends Action
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
    public function run($order = true)
    {
        if($order){
            $this->userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        }

        $users = $this->userRepository->paginate();

        return $users;
    }
}
