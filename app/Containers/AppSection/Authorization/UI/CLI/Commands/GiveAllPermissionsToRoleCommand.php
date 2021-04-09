<?php

namespace App\Containers\AppSection\Authorization\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Exceptions\RoleNotFoundException;
use App\Ship\Parents\Commands\ConsoleCommand;

class GiveAllPermissionsToRoleCommand extends ConsoleCommand
{
    protected $signature = 'apiato:permissions:toRole {role}';

    protected $description = 'Give all system Permissions to a specific Role.';

    public function handle(): void
    {
        $roleName = $this->argument('role');

        $allPermissions = Apiato::call('Authorization@GetAllPermissionsTask', [true]);

        $role = Apiato::call('Authorization@FindRoleTask', [$roleName]);

        if (!$role) {
            throw new RoleNotFoundException("Role $roleName is not found!");
        }

        $role->syncPermissions($allPermissionsNames = $allPermissions->pluck('name')->toArray());

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(' - ',
                $allPermissionsNames) . '.');
    }
}
