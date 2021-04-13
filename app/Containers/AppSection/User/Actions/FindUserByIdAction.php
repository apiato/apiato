<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Parents\Actions\Action;

class FindUserByIdAction extends Action
{
    public function run(FindUserByIdRequest $request): User
    {
        return app(FindUserByIdTask::class)->run($request->id);
    }
}
