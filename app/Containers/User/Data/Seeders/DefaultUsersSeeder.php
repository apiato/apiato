<?php

namespace App\Containers\User\Data\Seeders;

use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\User\Models\User;
use App\Port\Seeder\Abstracts\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class DefaultUsersSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DefaultUsersSeeder extends Seeder
{

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * DefaultUsersSeeder constructor.
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
        $admin = new User();
        $admin->name = 'Super Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('admin');
        $admin->save();
        $admin->assignRole($this->getRoleTask->run('admin'));
    }
}
