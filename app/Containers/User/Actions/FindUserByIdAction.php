<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class FindUserByIdAction extends Action
{
    public function run(FindUserByIdRequest $data): User
    {
        $user = Apiato::call('User@FindUserByIdTask', [$data->id]);

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
