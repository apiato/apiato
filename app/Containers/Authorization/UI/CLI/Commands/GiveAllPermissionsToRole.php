<?php

namespace App\Containers\Authorization\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;

class GiveAllPermissionsToRole extends ConsoleCommand
{

    protected $signature = 'apiato:permissions:toRole {role}';

    protected $description = 'Give all system Permissions to a specific Role.';

    public function handle()
    {
        $roleName = $this->argument('role');

        $allPermissionsNames = Apiato::call('Authorization@ListAllPermissionsTask', [true]);

        $role = Apiato::call('Authorization@GetRoleTask', [$roleName]);

        $role->syncPermissions($allPermissionsNames = $allPermissionsNames->pluck('name')->toArray());

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(' - ',
                $allPermissionsNames) . '.');
    }
}
