<?php

namespace App\Containers\Application\Data\Seeders;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Port\Seeder\Abstracts\Seeder;

class DeveloperRoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developerRole = new Role();
        $developerRole->name = 'developer';
        $developerRole->display_name = 'Developer';
        $developerRole->save();

        // ---------------------------------------

        $permission = new Permission();
        $permission->name = 'create-applications';
        $permission->description = 'Create Application to gain third party access using special token';
        $permission->save();

        $developerRole->givePermissionTo($permission);
        
    }
}
