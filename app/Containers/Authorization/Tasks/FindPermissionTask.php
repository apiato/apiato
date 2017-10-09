<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
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
     * @return  mixed
     */
    public function run($permissionNameOrId)
    {
        $query = is_numeric($permissionNameOrId) ? ['id' => $permissionNameOrId] : ['name' => $permissionNameOrId];

        return App::make(PermissionRepository::class)->findWhere($query)->first();
    }

}
