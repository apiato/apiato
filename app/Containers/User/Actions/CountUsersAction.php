<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Port\Action\Abstracts\Action;
use App\Port\Criterias\Eloquent\IsNullCriteria;
use App\Port\Criterias\Eloquent\NotNullCriteria;

/**
 * Class CountUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountUsersAction extends Action
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
     */
    public function all()
    {
        return $this->userRepository->all()->count();
    }

    /**
     * @return  mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function visitors()
    {
        $this->userRepository->pushCriteria(new IsNullCriteria('email'));

        return $this->userRepository->all()->count();
    }

    /**
     * @return  mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function registered()
    {
        $this->userRepository->pushCriteria(new NotNullCriteria('email'));

        return $this->userRepository->all()->count();
    }

}
