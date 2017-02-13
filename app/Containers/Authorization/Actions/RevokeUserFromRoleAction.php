<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\RevokeUserFromRoleTask;
use App\Port\Action\Abstracts\Action;

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
     * RevokeUserFromRoleAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\RevokeUserFromRoleTask $revokeUserFromRoleTask
     */
    public function __construct(RevokeUserFromRoleTask $revokeUserFromRoleTask)
    {
        $this->revokeUserFromRoleTask = $revokeUserFromRoleTask;
    }

    /**
     * @param $userId
     * @param $rolesNames array or string
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userId, $rolesNames)
    {
        return $this->revokeUserFromRoleTask->run($userId, $rolesNames);
    }
}
