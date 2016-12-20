<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Containers\Authorization\Traits\UserAuthorizationTrait;
use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;

/**
 * Class IsUserAdminTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class IsUserAdminTask extends Task
{
    use UserAuthorizationTrait;
    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return  bool
     */
    public function run(User $user)
    {
        // check if is Admin
        $isAdmin = $this->isUserAdmin($user);

        if (!$isAdmin) {
            throw new UserNotAdminException();
        }

        return true;
    }

}
