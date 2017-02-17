<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Task\Abstracts\Task;

/**
 * Class CreateRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateRoleTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\RoleRepository
     */
    private $roleRepository;

    /**
     * CreateRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
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

        return $this->roleRepository->create([
            'name'         => $name,
            'description'  => $description,
            'display_name' => $displayName,
        ]);
    }

}
