<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class CreatePermissionTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionTask extends Task
{

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     *
     * @return  \App\Containers\Authorization\Models\Permission
     */
    public function run(string $name, string $description = null, string $displayName = null): Permission
    {
        app()['cache']->forget('spatie.permission.cache');

        $permission = App::make(PermissionRepository::class)->create([
            'name'         => $name,
            'description'  => $description,
            'display_name' => $displayName,
            'guard_name'   => 'web',
        ]);

        return $permission;
    }

}
