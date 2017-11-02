<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @return mixed
     * @throws InternalErrorException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run($userData, $userId)
    {
        if (empty($userData)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        try {
            $user = App::make(UserRepository::class)->update($userData, $userId);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('User Not Found.');
        } catch (Exception $exception) {
            throw new InternalErrorException();
        }

        return $user;
    }

}
