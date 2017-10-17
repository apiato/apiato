<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class FindUserByIdTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdTask extends Task
{

    /**
     * @param $userId
     *
     * @return User
     * @throws NotFoundException
     */
    public function run($userId)
    {
        // find the user by its id
        try {
            $user = App::make(UserRepository::class)->find($userId);
        } catch (Exception $e) {
            throw new NotFoundException();
        }

        return $user;
    }

}
