<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\ListAllRolesTask;
use App\Port\Task\Abstracts\Task;

/**
 * Class ListAllRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllRolesAction extends Task
{

    /**
     * @var  \App\Containers\Authorization\Tasks\ListAllRolesTask
     */
    private $listAllRolesTask;

    /**
     * ListAllRolesAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\ListAllRolesTask $listAllRolesTask
     */
    public function __construct(ListAllRolesTask $listAllRolesTask)
    {
        $this->listAllRolesTask = $listAllRolesTask;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->listAllRolesTask->run();
    }

}
