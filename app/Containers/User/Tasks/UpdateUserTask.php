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
        // set all data in the array, then remove all null values and their keys
        $attributes = array_filter($userData);

        // optionally, check if data is empty and return error
        if (!$attributes) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        // updating the attributes
        return App::make(UserRepository::class)->update($attributes, $userId);;
    }

}
