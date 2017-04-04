<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

/**
 * Class IsUserAdminTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class IsUserAdminTask extends Task
{

    /**
     * @param \App\Containers\User\Models\User|null $user
     *
     * @return  bool
     * @throws \App\Containers\Authorization\Exceptions\UserNotAdminException
     */
    public function run(User $user = null)
    {
        // check if is Admin
        if (!$user->hasAdminRole()) {
            throw new UserNotAdminException();
        }

        return true;
    }

}
