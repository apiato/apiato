<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class ListAllPermissionsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllPermissionsTask extends Task
{
    /**
     * @return  mixed
     */
    public function run()
    {
        return App::make(PermissionRepository::class)->all();
    }

}
