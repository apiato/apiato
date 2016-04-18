<?php

namespace Mega\Modules\User\Tasks;

use Mega\Services\Core\Task\Abstracts\Task;

/**
 * Class AssignUserRolesTask
 *
 * @type Task
 * @package  Mega\Modules\User\Tasks
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserRolesTask extends Task
{

    /**
     * @param $user
     */
    public function run($user)
    {
        // ...

        return $user;
    }

}
