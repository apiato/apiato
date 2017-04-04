<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebLogoutTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class WebLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLogoutAction extends Action
{
    /**
     * @return bool
     */
    public function run()
    {
        return $this->call(WebLogoutTask::class);
    }
}
