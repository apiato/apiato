<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class CreatePermissionTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionTask extends Task
{

    private $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     *
     * @return Permission
     * @throws CreateResourceFailedException
     */
    public function run(string $name, string $description = null, string $displayName = null): Permission
    {
        app()['cache']->forget('spatie.permission.cache');

        $data = [
            'name'         => $name,
            'description'  => $description,
            'display_name' => $displayName,
            'guard_name'   => 'web',
        ];

        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
