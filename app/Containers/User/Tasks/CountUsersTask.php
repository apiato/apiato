<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class CountAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountUsersTask extends Task
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
        return $this->repository->all()->count();
    }

}
