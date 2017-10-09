<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;

/**
 * Class FindAuthenticatedUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindAuthenticatedUserTask extends Task
{

    /**
     * @return  \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function run()
    {
        return Auth::user();
    }

}
