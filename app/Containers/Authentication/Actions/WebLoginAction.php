<?php

namespace App\Containers\Authentication\Actions;

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
        $user = $this->call('Authentication@WebLoginTask', [$request]);

        $this->call('Authentication@CheckIfUserIsConfirmedTask', [], [['setUser' => [$user]]]);

        return $user;
    }
}
