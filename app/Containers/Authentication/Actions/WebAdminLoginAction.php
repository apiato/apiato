<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Containers\Authorization\Tasks\ValidateIsAdminTask;
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
        $user = $this->call(WebLoginTask::class, [$request->email, $request->password, $request->remember_me]);

        if (!$user->hasAdminRole()) {
            throw new UserNotAdminException();
        }

        return $user;
    }
}
