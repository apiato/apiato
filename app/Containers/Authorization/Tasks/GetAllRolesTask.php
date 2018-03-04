<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetAllRolesTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllRolesTask extends Task
{

    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param bool $skipPagination
     *
     * @return  mixed
     */
    public function run($skipPagination = false)
    {
        return $skipPagination ? $this->repository->all() : $this->repository->paginate();
    }

}
