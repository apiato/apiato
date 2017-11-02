<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;

/**
 * Class CreatePasswordResetTask
 *
 * @author  Sebastian Weckend
 */
class CreatePasswordResetTask extends Task
{

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(User $user)
    {
        try {
            return app('auth.password.broker')->createToken($user);
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
