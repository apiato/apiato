<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

/**
 * Class ApiLoginFromUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginFromUserTask extends Task
{
    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return  \Laravel\Passport\PersonalAccessTokenResult
     */
    public function run(User $user)
    {
        $personalAccessTokenResult = $user->createToken('social');

        return $personalAccessTokenResult;
    }

}
