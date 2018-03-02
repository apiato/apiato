<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UpdateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTask extends Task
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $userData
     * @param $userId
     *
     * @return mixed
     * @throws InternalErrorException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userData, $userId): User
    {
        if (empty($userData)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        try {
            $user = $this->repository->update($userData, $userId);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('User Not Found.');
        } catch (Exception $exception) {
            throw new InternalErrorException();
        }

        return $user;
    }

}
