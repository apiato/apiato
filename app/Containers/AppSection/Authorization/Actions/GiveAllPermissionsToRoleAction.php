<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use Prettus\Repository\Exceptions\RepositoryException;

class GiveAllPermissionsToRoleAction extends Action
{
    /**
     * @param string $roleName
     * @return array
     * @throws NotFoundException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(string $roleName): array
    {
        $role = app(FindRoleTask::class)->run($roleName);
        $allPermissionsNames = app(GetAllPermissionsTask::class)->run(true)->pluck('name')->toArray();
        $role->syncPermissions($allPermissionsNames);

        return $allPermissionsNames;
    }
}
