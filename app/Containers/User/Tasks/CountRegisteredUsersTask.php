<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\NotNullCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class CountRegisteredUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountRegisteredUsersTask extends Task
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return  int
     */
    public function run(): int
    {
        $this->repository->pushCriteria(new NotNullCriteria('email'));
        return $this->repository->all()->count();
    }

}
