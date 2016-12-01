<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Port\Action\Abstracts\Action;
use App\Port\Criterias\Eloquent\IsNullCriteria;

/**
 * Class CountVisitorUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountVisitorUsersTask extends Action
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
        $this->userRepository->pushCriteria(new IsNullCriteria('email'));

        return $this->userRepository->all()->count();
    }

}
