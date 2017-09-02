<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
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
     * @param      $name
     * @param null $description
     * @param null $displayName
     *
     * @return  mixed
     */
    public function run($name, $description = null, $displayName = null)
    {
        app()['cache']->forget('spatie.permission.cache');

        return App::make(PermissionRepository::class)->create([
            'name'         => $name,
            'description'  => $description,
            'display_name' => $displayName,
            'guard_name'   => 'web',
        ]);
    }

}
