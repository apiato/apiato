<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;

/**
 * Class GetAuthenticatedUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAuthenticatedUserTask extends Task
{


    /**
     * @param null $token
     *
     * @return  mixed
     */
    public function run($token = null) // TODO: remove this parameter
    {
        return Auth::user();
    }

}
