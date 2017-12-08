<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class FindPermissionTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionTask extends Task
{

    /**
     * @param $permissionNameOrId
     *
     * @return  Permission
     */
    public function run($permissionNameOrId): Permission
    {
        $query = is_numeric($permissionNameOrId) ? ['id' => $permissionNameOrId] : ['name' => $permissionNameOrId];

        $permission = App::make(PermissionRepository::class)->findWhere($query)->first();

        return $permission;
    }

}
