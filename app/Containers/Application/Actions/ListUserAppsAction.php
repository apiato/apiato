<?php

namespace App\Containers\Application\Actions;

use App\Containers\Application\Tasks\ListUserAppsTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListUserAppsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListUserAppsAction extends Action
{

    /**
     * @var  \App\Containers\Application\Tasks\ListUserAppsTask
     */
    private $listUserAppsTask;

    /**
     * ListAllAppsAction constructor.
     *
     * @param \App\Containers\Application\Tasks\ListUserAppsTask $listUserAppsTask
     */
    public function __construct(ListUserAppsTask $listUserAppsTask)
    {
        $this->listUserAppsTask = $listUserAppsTask;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->listUserAppsTask->run();
    }

}
