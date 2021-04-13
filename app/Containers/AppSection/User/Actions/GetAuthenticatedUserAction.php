<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;

class GetAuthenticatedUserAction extends Action
{
    public function run(): User
    {
        $user = app(GetAuthenticatedUserTask::class)->run();

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
