<?php

namespace App\Containers\Authorization\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Ship\Parents\Commands\ConsoleCommand;

/**
 * Class GiveAllPermissionsToRoleCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GiveAllPermissionsToRoleCommand extends ConsoleCommand
{

    protected $signature = 'apiato:permissions:toRole {role}';

    protected $description = 'Give all system Permissions to a specific Role.';

    /**
     * @void
     */
    public function handle()
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
