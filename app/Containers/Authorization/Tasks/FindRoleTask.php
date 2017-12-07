<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class FindRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleTask extends Task
{

    /**
     * @param $roleNameOrId
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run($roleNameOrId): Role
    {
        $query = is_numeric($roleNameOrId) ? ['id' => $roleNameOrId] : ['name' => $roleNameOrId];

        $role = App::make(RoleRepository::class)->findWhere($query)->first();

        return $role;
    }

}
