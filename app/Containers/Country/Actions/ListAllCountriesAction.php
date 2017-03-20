<?php

namespace App\Containers\Country\Actions;

use App\Containers\Country\Tasks\ListAllCountriesTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ListAllCountriesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllCountriesAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->call(ListAllCountriesTask::class);
    }
}
