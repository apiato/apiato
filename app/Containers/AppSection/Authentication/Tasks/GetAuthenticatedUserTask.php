<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class GetAuthenticatedUserTask extends Task
{
    /**
     * @throws NotFoundException
     */
    public function run(): Authenticatable
    {
        $user = Auth::user();

        if (is_null($user)) {
            throw new NotFoundException();
        }

        return $user;
    }
}
