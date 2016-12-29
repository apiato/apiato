<?php

namespace App\Containers\User\Policies;

use App\Containers\User\Models\User;
use App\Port\Policy\Abstracts\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserPolicy extends Policy
{

    use HandlesAuthorization;

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return  bool
     */
    public function list(User $user)
    {
        return $user->hasPermissionTo('list-all-users');
    }

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return  bool
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('delete-user');
    }
}
