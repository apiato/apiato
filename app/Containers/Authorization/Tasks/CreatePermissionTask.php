<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class CreatePermissionTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreatePermissionTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\PermissionRepository
     */
    private $permissionRepository;

    /**
     * CreatePermissionTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param $name
     * @param $description
     * @param $displayName
     *
     * @return  mixed
     */
    public function run($name, $description = null, $displayName = null)
    {

        return $this->permissionRepository->create([
            'name'         => $name,
            'description'  => $description,
            'display_name' => $displayName,
        ]);
    }

}
