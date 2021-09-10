<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllRolesTask extends Task
{
    public function __construct(
        protected RoleRepository $repository
    ) {
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
