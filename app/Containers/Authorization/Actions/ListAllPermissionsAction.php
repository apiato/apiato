<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\ListAllPermissionsTask;
use App\Ship\Parents\Tasks\Task;

/**
 * Class ListAllPermissionsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllPermissionsAction extends Task
{

    /**
     * @var  \App\Containers\Authorization\Tasks\ListAllPermissionsTask
     */
    private $listAllPermissionsTask;

    /**
     * ListAllPermissionsAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\ListAllPermissionsTask $listAllPermissionsTask
     */
    public function __construct(ListAllPermissionsTask $listAllPermissionsTask)
    {
        $this->listAllPermissionsTask = $listAllPermissionsTask;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->listAllPermissionsTask->run();
    }

}
