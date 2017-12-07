<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class AssignUserToRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleTask extends Task
{

    /**
     * @param \App\Containers\User\Models\User $user
     * @param array                            $roles
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(User $user, array $roles) : Authenticatable
    {
        return $user->assignRole($roles);
    }

}
