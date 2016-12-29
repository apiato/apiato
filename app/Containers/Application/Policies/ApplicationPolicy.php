<?php

namespace App\Containers\Application\Policies;

use App\Containers\Application\Models\Application;
use App\Containers\User\Models\User;
use App\Port\Policy\Abstracts\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ApplicationPolicy.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApplicationPolicy extends Policy
{

    use HandlesAuthorization;

    /**
     * @param \App\Containers\Application\Models\Application $application
     *
     * @return  mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-applications');
    }

}
