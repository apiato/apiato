<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\UserNotAdminException;
use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;

/**
 * Class ValidateUserIsAdminTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidateUserIsAdminTask extends Task
{

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return  bool
     */
    public function run(User $user)
    {
        // check if is Admin
        $isAdmin = $user->hasRole('admin');

        if (!$isAdmin) {
            throw new UserNotAdminException();
        }

        return true;
    }

}
