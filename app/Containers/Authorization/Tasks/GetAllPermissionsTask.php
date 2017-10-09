<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class GetAllPermissionsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllPermissionsTask extends Task
{
    /**
     * @var PermissionRepository
     */
    private $repository;

    /**
     * GetAllPermissionsTask constructor.
     *
     * @param PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->repository->all();
    }

}
