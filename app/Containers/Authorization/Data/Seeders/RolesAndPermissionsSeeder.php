<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\User\Models\User;
use App\Port\Seeder\Abstracts\Seeder;
use Illuminate\Support\Facades\Hash;

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

        $admin = new User();
        $admin->name = 'Super Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('admin');
        $admin->save();

        $admin->attachRole($adminRole);

        $accessDashboardPermission = new Permission();
        $accessDashboardPermission->name = 'access-dashboard';
        $accessDashboardPermission->display_name = 'Access the Admins Dashboard';
        $accessDashboardPermission->save();

        $adminRole->attachPermission($accessDashboardPermission);
    }
}
