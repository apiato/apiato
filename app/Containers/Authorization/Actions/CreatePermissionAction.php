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
     * @var  \App\Containers\Authorization\Tasks\CreatePermissionTask
     */
    private $createPermissionTask;

    /**
     * CreatePermissionAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\CreatePermissionTask $createPermissionTask
     */
    public function __construct(CreatePermissionTask $createPermissionTask)
    {
        $this->createPermissionTask = $createPermissionTask;
    }

    /**
     * @param      $name
     * @param null $description
     * @param null $displayName
     *
     * @return  mixed
     */
    public function run($name, $description = null, $displayName = null)
    {
        return $this->createPermissionTask->run($name, $description, $displayName);
    }
}
