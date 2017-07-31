<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\NotNullCriteria;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class CountRegisteredUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountRegisteredUsersTask extends Task
{
    /**
     * @return  mixed
     */
    public function run()
    {
        return App::make(UserRepository::class)->pushCriteria(new NotNullCriteria('email'))->all()->count();
    }

}
