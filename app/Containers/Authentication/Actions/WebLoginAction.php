<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\CheckIfUserIsConfirmedTask;
use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = $this->call(WebLoginTask::class, [$request]);

        $this->call(CheckIfUserIsConfirmedTask::class, [], [['setUser' => [$user]]]);

        return $user;
    }
}
