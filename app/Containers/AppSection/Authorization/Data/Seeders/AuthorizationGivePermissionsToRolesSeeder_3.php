<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationGivePermissionsToRolesSeeder_3 extends ParentSeeder
{
    public function run(PermissionRepository $repository): void
    {
        // Give all permissions to 'admin' role on all Guards ----------------------------------------------------------------
        $adminRoleName = config('appSection-authorization.admin_role');
        $roleModel = config('permission.models.role');
        foreach (array_keys(config('auth.guards')) as $guardName) {
            $allPermissions = $repository->whereGuard($guardName)->all();
            $adminRole = $roleModel::findByName($adminRoleName, $guardName);
            $adminRole->givePermissionTo($allPermissions);
        }

        // Give permissions to roles ----------------------------------------------------------------
        //
    }
}
