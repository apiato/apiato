<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Parents\Actions\Action;

class FindUserByIdAction extends Action
{
    public function run(FindUserByIdRequest $data): User
    {
        return Apiato::call('User@FindUserByIdTask', [$data->id]);
    }
}
