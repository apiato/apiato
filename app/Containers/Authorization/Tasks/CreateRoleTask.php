<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

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
    protected $repository;

    /**
     * CreateRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     * @param int         $level
     *
     * @return Role
     * @throws CreateResourceFailedException
     */
    public function run(string $name, string $description = null, string $displayName = null, int $level = 0): Role
    {
        app()['cache']->forget('spatie.permission.cache');

        try {
            $role = $this->repository->create([
                'name'         => strtolower($name),
                'description'  => $description,
                'display_name' => $displayName,
                'guard_name'   => 'web',
                'level'        => $level,
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }

        return $role;
    }

}
