<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Laravel\Passport\PersonalAccessTokenResult;

/**
 * Class ApiLoginFromUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginFromUserTask extends Task
{
    public function run(User $user): PersonalAccessTokenResult
    {
        return $user->createToken('social');
    }
}
