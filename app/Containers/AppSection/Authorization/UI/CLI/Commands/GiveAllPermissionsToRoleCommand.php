<?php

namespace App\Containers\AppSection\Authorization\UI\CLI\Commands;

use App\Containers\AppSection\Authorization\Actions\GetAllPermissionsAction;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Commands\ConsoleCommand;

class GiveAllPermissionsToRoleCommand extends ConsoleCommand
{
    protected $signature = 'apiato:permissions:toRole {role}';

    protected $description = 'Give all system Permissions to a specific Role.';

    /**
     * @throws NotFoundException
     */
    public function handle(): void
    {
        $roleName = $this->argument('role');
        $role = app(FindRoleTask::class)->run($roleName);

        config(['repository.pagination.skip' => true]);
        $allPermissions = app(GetAllPermissionsAction::class)->run(new GetAllPermissionsRequest(['limit' => 0]));

        $role->syncPermissions($allPermissionsNames = $allPermissions->pluck('name')->toArray());

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(
            ' - ',
            $allPermissionsNames
        ) . '.');
    }
}
