<?php

namespace App\Containers\Country\Actions;

use App\Containers\Country\Tasks\ListAllCountriesTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListAllCountriesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllCountriesAction extends Action
{

    /**
     * @var  \App\Containers\Country\Tasks\ListAllCountriesTask
     */
    private $listAllCountriesTask;

    /**
     * ListAllCountriesAction constructor.
     *
     * @param \App\Containers\Country\Tasks\ListAllCountriesTask $listAllCountriesTask
     */
    public function __construct(ListAllCountriesTask $listAllCountriesTask)
    {
        $this->listAllCountriesTask = $listAllCountriesTask;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->listAllCountriesTask->run();
    }

}
