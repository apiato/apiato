<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class GetUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     * @throws \App\Containers\User\Exceptions\UserNotFoundException
     */
    public function run(Request $request)
    {
        $userId = $request->id;

        $user = $this->call(FindUserByIdTask::class, [$userId]);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
