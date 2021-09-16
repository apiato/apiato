<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;

class GiveAllPermissionsToRoleAction extends Action
{
    /**
     * @throws NotFoundException
     */
    public function run(string $roleName): array
    {
        $role = app(FindRoleTask::class)->run($roleName);
        $allPermissionsNames = app(GetAllPermissionsTask::class)->run(true)->pluck('name')->toArray();
        $role->syncPermissions($allPermissionsNames);

        return $allPermissionsNames;
    }
}
