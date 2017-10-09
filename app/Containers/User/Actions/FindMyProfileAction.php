<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindMyProfileAction extends Action
{
    public function run(Request $request)
    {
        $user = $this->call(FindAuthenticatedUserTask::class);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
