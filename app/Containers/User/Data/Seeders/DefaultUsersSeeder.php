<?php

namespace App\Containers\User\Data\Seeders;

use App\Containers\Authorization\Tasks\GetAdminRoleTask;
use App\Containers\User\Models\User;
use App\Port\Seeder\Abstracts\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{

    /**
     * @var  \App\Containers\Authorization\Data\Seeders\GetAdminRoleTask
     */
    private $getAdminRoleTask;

    /**
     * DefaultUsersSeeder constructor.
     *
     * @param \App\Containers\Authorization\Data\Seeders\GetAdminRoleTask $getAdminRoleTask
     */
    public function __construct(GetAdminRoleTask $getAdminRoleTask)
    {
        $this->getAdminRoleTask = $getAdminRoleTask;
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
        $admin->attachRole($this->getAdminRoleTask->run());
    }
}
