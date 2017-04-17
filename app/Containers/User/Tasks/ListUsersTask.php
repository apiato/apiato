<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Criterias\NoRolesCriteria;
use App\Containers\User\Data\Criterias\RoleCriteria;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;

/**
 * Class ListUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListUsersTask extends Action
{

    /**
     * @param bool $ordered
     * @param bool $allUsers
     * @param null $roles
     *
     * @return  mixed
     */
    public function run($ordered = true, $allUsers = false, $roles = null)
    {
        $userRepository = App::make(UserRepository::class);
        
        // if he doesn't need all users means he might need to filter by roles
        if (!$allUsers) {
            if ($roles) {
                $userRepository->pushCriteria(new RoleCriteria($roles));
            } else {
                // if no roles specified means he wants only users with has no roles (normal clients usually)
                $userRepository->pushCriteria(new NoRolesCriteria());
            }
        }

        if ($ordered) {
            $userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        }

        return $userRepository->paginate();
    }
}
