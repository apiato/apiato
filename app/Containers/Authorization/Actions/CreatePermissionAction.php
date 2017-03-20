<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreatePermissionAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionAction extends Action
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
        return $this->call(CreatePermissionTask::class, [$name, $description, $displayName]);
    }
}
