<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetMyProfileAction extends Action
{
    public function run(Request $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        return $user;
    }
}
