<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\Authorization\Tasks\RevokeUserFromRoleTask;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Action\Abstracts\Action;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RevokeUserFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\RevokeUserFromRoleTask
     */
    private $revokeUserFromRoleTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * RevokeUserFromRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\RevokeUserFromRoleTask $revokeUserFromRoleTask
     * @param \App\Containers\User\Tasks\FindUserByIdTask                $findUserByIdTask
     * @param \App\Containers\Authorization\Tasks\GetRoleTask            $getRoleTask
     */
    public function __construct(
        RevokeUserFromRoleTask $revokeUserFromRoleTask,
        FindUserByIdTask $findUserByIdTask,
        GetRoleTask $getRoleTask
    ) {
        $this->revokeUserFromRoleTask = $revokeUserFromRoleTask;
        $this->findUserByIdTask = $findUserByIdTask;
        $this->getRoleTask = $getRoleTask;
    }

    /**
     * @param User|integer $userId
     * @param integer|array $rolesIds
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($user, $rolesIds)
    {
        if (!$user instanceof User) {
            $user = $this->findUserByIdTask->run($user);
        }

        if (!is_array($rolesIds)) {
            $rolesIds = [$rolesIds];
        }

        $roles = new Collection();

        foreach ($rolesIds as $roleId) {
            $roles->add($this->getRoleTask->run($roleId));
        }

        return $this->revokeUserFromRoleTask->run($user, $roles->pluck('name')->toArray());
    }
}
