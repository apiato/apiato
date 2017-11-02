<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class WebAdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAdminLoginAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     * @throws \App\Containers\Authorization\Exceptions\UserNotAdminException
     */
    public function run(Request $request)
    {
        $user = Apiato::call('Authentication@WebLoginTask',
            [$request->email, $request->password, $request->remember_me ?? false]);

        Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [], [['setUser' => [$user]]]);

        if (!$user->hasAdminRole()) {
            throw new UserNotAdminException();
        }

        return $user;
    }
}
