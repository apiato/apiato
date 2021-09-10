<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllPermissionsTask extends Task
{
    public function __construct(
        protected PermissionRepository $repository
    ) {
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
