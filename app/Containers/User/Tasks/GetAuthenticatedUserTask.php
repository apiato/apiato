<?php

namespace App\Containers\User\Tasks;

use App\Port\Task\Abstracts\Task;
use Illuminate\Support\Facades\Auth;

/**
 * Class GetAuthenticatedUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAuthenticatedUserTask extends Task
{

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run()
    {
        $user = Auth::user();

        return $user;
    }

}
