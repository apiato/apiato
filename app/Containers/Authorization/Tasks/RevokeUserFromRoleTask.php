<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;

/**
 * Class RevokeUserFromRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleTask extends Task
{

    /**
     * @param \App\Containers\User\Models\User $user
     * @param array                            $rolesNames
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(User $user, array $rolesNames)
    {
        foreach ($rolesNames as $roleName) {
            $user->removeRole($roleName);
        }

        return $user;
    }

}
