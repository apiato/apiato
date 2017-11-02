<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class CreateRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateRoleTask extends Task
{

    /**
     * @param     $name
     * @param     $description
     * @param     $displayName
     * @param int $level
     *
     * @return mixed
     */
    public function run($name, $description = null, $displayName = null, $level = 0)
    {
        app()['cache']->forget('spatie.permission.cache');

        return App::make(RoleRepository::class)->create([
            'name'         => strtolower($name),
            'description'  => $description,
            'display_name' => $displayName,
            'guard_name'   => 'web',
            'level'        => $level,
        ]);
    }

}
