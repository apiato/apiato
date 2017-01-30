<?php

namespace App\Containers\Application\Actions;

use App\Containers\Application\Tasks\ListAllAppsTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListAllAppsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllAppsAction extends Action
{

    /**
     * @var  \App\Containers\Application\Tasks\ListAllAppsTask
     */
    private $listAllAppsTask;

    /**
     * ListAllAppsAction constructor.
     *
     * @param \App\Containers\Application\Tasks\ListAllAppsTask $listAllAppsTask
     */
    public function __construct(ListAllAppsTask $listAllAppsTask)
    {
        $this->listAllAppsTask = $listAllAppsTask;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->listAllAppsTask->run();
    }

}
