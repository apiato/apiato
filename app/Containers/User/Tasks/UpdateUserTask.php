<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class UpdateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTask extends Task
{

    /**
     * @param $userData
     * @param $userId
     *
     * @return  mixed
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run($userData, $userId)
    {
        if (empty($userData)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        return App::make(UserRepository::class)->update($userData, $userId);
    }

}
