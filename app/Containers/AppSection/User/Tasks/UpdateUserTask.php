<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UpdateUserTask extends Task
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $userData, $userId): User
    {
        if (empty($userData)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        try {
            // hash password if exist (before updating user)
            if (array_key_exists('password', $userData)) {
                $userData['password'] = Hash::make($userData['password']);
            }

            $user = $this->repository->update($userData, $userId);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('User Not Found.');
        } catch (Exception $exception) {
            throw new InternalErrorException();
        }

        return $user;
    }
}
