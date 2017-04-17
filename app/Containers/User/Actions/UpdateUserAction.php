<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        // user can only update himself
        $userId = $this->call(GetAuthenticatedUserTask::class)->id;

        return $this->call(UpdateUserTask::class,
            [$userId, $request->password, $request->name, $request->email, $request->gender, $request->birth]);
    }
}
