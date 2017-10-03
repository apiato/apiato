<?php

namespace App\Containers\Authorization\UI\CLI\Commands;

use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\Authorization\Tasks\ListAllPermissionsTask;
use App\Ship\Parents\Commands\ConsoleCommand;
use Illuminate\Support\Facades\App;

class GiveAllPermissionsToRole extends ConsoleCommand
{

    protected $signature = 'apiato:permissions:toRole {role}';

    protected $description = 'Give all system Permissions to a specific Role.';

    public function handle()
    {
        $roleName = $this->argument('role');

        $allPermissionsNames = App::make(ListAllPermissionsTask::class)->run(true)->pluck('name')->toArray();

        $role = App::make(GetRoleTask::class)->run($roleName)->syncPermissions($allPermissionsNames);

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(' - ',
                $allPermissionsNames) . '.');
    }
}
