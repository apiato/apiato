<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Spatie\Permission\Models\Role;

class AuthorizationGivePermissionsToRolesSeeder_3 extends ParentSeeder
{
    public function run(): void
    {
        // Give all permissions to 'admin' role on all Guards ----------------------------------------------------------------
        $adminRoleName = config('appSection-authorization.admin_role');
        foreach (array_keys(config('auth.guards')) as $guardName) {
            $allPermissions = app(GetAllPermissionsTask::class)->whereGuard($guardName)->run(true);
            $adminRole = Role::findByName($adminRoleName, $guardName);
            $adminRole->givePermissionTo($allPermissions);
        }

        // Give permissions to roles ----------------------------------------------------------------
        //
    }
}
