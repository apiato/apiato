<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Port\Action\Abstracts\Action;
use App\Port\Criterias\Eloquent\NotNullCriteria;

/**
 * Class CountRegisteredUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountRegisteredUsersTask extends Action
{

    /**
     * CountUsersAction constructor.
     *
     * @param \App\Containers\User\Data\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return  mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function run()
    {
        $this->userRepository->pushCriteria(new NotNullCriteria('email'));

        return $this->userRepository->all()->count();
    }

}
