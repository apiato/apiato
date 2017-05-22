<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class CountAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountUsersTask extends Task
{
    /**
     * @return  mixed
     */
    public function run()
    {
        return App::make(UserRepository::class)->all()->count();
    }

}
