<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Port\Seeder\Abstracts\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'Administrator';
        $adminRole->save();

        $accessDashboardPermission = new Permission();
        $accessDashboardPermission->name = 'access-dashboard';
        $accessDashboardPermission->display_name = 'Access the Admins Dashboard';
        $accessDashboardPermission->save();

        $adminRole->attachPermission($accessDashboardPermission);
    }
}
