<?php

namespace App\Containers\AppSection\Authorization\UI\CLI\Commands;

use App\Containers\AppSection\Authorization\Actions\GiveAllPermissionsToRoleAction;
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

        $allPermissionsNames = app(GiveAllPermissionsToRoleAction::class)->run($roleName);

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(
            ' - ',
            $allPermissionsNames
        ) . '.');
    }
}
