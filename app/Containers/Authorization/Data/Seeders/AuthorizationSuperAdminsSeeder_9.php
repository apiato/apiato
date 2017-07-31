<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthorizationSuperAdminsSeeder_9
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationSuperAdminsSeeder_9 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Users ----------------------------------------------------------------

        $admin = new User();
        $admin->name = 'Super Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('admin');
        $admin->save();
        $admin->assignRole(App::make(GetRoleTask::class)->run('admin'));

        // ...

    }
}
