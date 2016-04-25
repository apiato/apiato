<?php

namespace Mega\Services\Authorization\Seeders;

use Illuminate\Database\Seeder;
use Mega\Services\Authorization\Models\Role;

class SeedRolesAndPermissions extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
        $owner->name = 'member';
        $owner->display_name = 'Normal Member';
        $owner->description = 'All users will be normal members by default.';
        $owner->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin';
        $admin->description = 'This is an Administrator user.';
        $admin->save();
    }
}
