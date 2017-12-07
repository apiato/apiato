<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
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
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     * @param int         $level
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(string $name, string $description = null, string $displayName = null, int $level = 0): Role
    {
        app()['cache']->forget('spatie.permission.cache');

        $role = App::make(RoleRepository::class)->create([
            'name'         => strtolower($name),
            'description'  => $description,
            'display_name' => $displayName,
            'guard_name'   => 'web',
            'level'        => $level,
        ]);

        return $role;
    }

}
