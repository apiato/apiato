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

        $roleDeveloper = Role::create([
            'name'         => 'developer',
            'description'  => 'A developer account, has access to the API',
            'display_name' => '',
        ]);
        
        // ---------------------------------------

        $p = Permission::create([
            'name'         => 'create-applications',
            'description'  => 'Create Application to gain third party access using special token',
            'display_name' => '',
        ]);
        
        $roleDeveloper->givePermissionTo($p);
        
    }
}
