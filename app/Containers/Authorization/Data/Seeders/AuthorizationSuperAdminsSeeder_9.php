<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\User\Models\User;
use App\Port\Seeder\Abstracts\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthorizationSuperAdminsSeeder_9
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationSuperAdminsSeeder_9 extends Seeder
{

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * SuperAdminSeeder constructor.
     *
     * @param \App\Containers\Authorization\Tasks\GetRoleTask $getRoleTask
     */
    public function __construct(GetRoleTask $getRoleTask)
    {
        $this->getRoleTask = $getRoleTask;
    }

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
        $admin->assignRole($this->getRoleTask->run('admin'));

        // ...

    }
}
