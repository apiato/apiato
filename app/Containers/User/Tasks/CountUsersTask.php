<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;

/**
 * Class CountAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountUsersTask extends Action
{
    /**
     * @return  mixed
     */
    public function run()
    {
        return App::make(UserRepository::class)->all()->count();
    }

}
