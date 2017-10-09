<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
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
     * @return  mixed
     */
    public function run($roleNameOrId)
    {
        $query = is_numeric($roleNameOrId) ? ['id' => $roleNameOrId] : ['name' => $roleNameOrId];

        return App::make(RoleRepository::class)->findWhere($query)->first();
    }

}
