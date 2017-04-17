<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;

/**
 * Class DeleteUserTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteUserTask extends Action
{

    /**
     * @param $user
     *
     * @return  bool
     */
    public function run($user)
    {
        return App::make(UserRepository::class)->delete($user->id);
    }
}
