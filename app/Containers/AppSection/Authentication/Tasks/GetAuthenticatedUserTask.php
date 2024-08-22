<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class GetAuthenticatedUserTask extends ParentTask
{
    public function run(): Authenticatable|User
    {
        $result = Auth::user();

        if (null === $result) {
            throw new \RuntimeException('You are not authenticated.');
        }

        return $result;
    }
}
