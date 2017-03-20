<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\CreateRoleTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateRoleAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateRoleAction extends Action
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
        return $this->call(CreateRoleTask::class, [$name, $description, $displayName]);
    }
}
