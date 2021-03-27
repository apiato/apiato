<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Parents\Actions\Action;

class FindUserByIdAction extends Action
{
    public function run(FindUserByIdRequest $data): User
    {
        return Apiato::call('User@FindUserByIdTask', [$data->id]);
    }
}
