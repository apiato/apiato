<?php

namespace App\Containers\Application\Data\Seeders;

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
        $adminRole = new Role();
        $adminRole->name = 'developer';
        $adminRole->display_name = 'Developer';
        $adminRole->save();
    }
}
