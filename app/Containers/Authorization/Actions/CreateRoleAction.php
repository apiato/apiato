<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\CreateRoleTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class CreateRoleAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\CreateRoleTask
     */
    private $createRoleTask;

    /**
     * CreateRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\CreateRoleTask $createRoleTask
     */
    public function __construct(CreateRoleTask $createRoleTask)
    {
        $this->createRoleTask = $createRoleTask;
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
        return $this->createRoleTask->run($name, $description, $displayName);
    }
}
