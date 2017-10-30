<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class FindUserByEmailTask
 *
 * @author  Sebastian Weckend
 */
class FindUserByEmailTask extends Task
{

    /**
     * @param $email
     *
     * @return  mixed
     */
    public function run($email)
    {
        // find the user by its email
        try {
            $user = App::make(UserRepository::class)->findByField('email', $email)->first();
        } catch (Exception $e) {
            throw new NotFoundException();
        }

        return $user;
    }
}
